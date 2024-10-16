<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Image;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    //Create
    public $name;
    public $image;
    public $description;
    public $price;
    public $sections;
    public $is_active;

    //Image
    public $image_width = 200;
    public $image_height = 200;

    protected $listeners = [
        'ServicesCreateChange',
        'ServicesCreateRender' => 'render'
    ];
    public function hydrate()
    {
        $this->dispatch('ServicesCreateHydrate');
    }
    public function ServicesCreateChange($value, $key)
    {
        $this->$key = $value;
    }
    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:1024',
            'price' => 'required|numeric|digits_between:0,8',
            'sections' => 'required|integer|min:1',
            'is_active' => 'required|boolean'
        ];

        return $rules;
    }
    protected $messages = [
        'image.image' => 'The image must be an image.',
        'image.max' => 'The photo may not be greater than :max kilobytes.',
        'price.digits_between' => 'Price must be between :min and :max',
    ];
    public  function closeAndClean()
    {
        $this->reset([
            'name',
            'image',
            'description',
            'price',
            'sections',
            'is_active',
        ]);
        $this->resetValidation([
            'name',
            'image',
            'description',
            'price',
            'sections',
            'is_active',
        ]);
    }
    public function messages()
    {
        return [
            'image.image' => 'The photo must be an image.',
            'image.max' => 'The photo may not be greater than :max kilobytes.',
        ];
    }
    public function save()
    {
        $this->validate();

        $photo = null;
        if ($this->image) {
            $photo = Str::slug($this->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image->getClientOriginalExtension();
            Image::make($this->image)->resize($this->image_width, $this->image_height)->save(public_path('uploads/services/'.$photo, 50));
        }
        $service = new Service();
        $service->name = $this->name;
        $service->image = $photo;
        $service->description = $this->description;
        $service->price = $this->price;
        $service->sections = $this->sections;
        $service->is_active = $this->is_active;
        // dd($service);
        $service->save();

        $this->dispatch('services.show','render');
        $this->dispatch('alert', __('Registered Alert!'), '#create');
        $this->dispatch('ServicesShowRender');
        $this->closeAndClean();
    }
    public function render()
    {
        return view('livewire.service.create');
    }
}
