<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Image;
use Livewire\Component;

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
        'ServicesCreateChange'
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
            'image' => 'required|image|max:1024',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sections' => 'required|integer|min:1',
            'is_active' => 'required|boolean'
        ];

        return $rules;
    }
    protected $messages = [
        'name.required'=>'Name is required',
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
        dd($service);
        $service->save();

        $this->dispatchTo('services.show','render');
        $this->dispatch('alert',__('Registered Service!'),'#create');
        $this->dispatch('ServicesShowRender');
        $this->closeAndClean();
    }
    public function render()
    {
        return view('livewire.service.create');
    }
}
