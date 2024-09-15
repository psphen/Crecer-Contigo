<?php

namespace App\Http\Livewire\Services;

use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
Use Image;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    //Create
    public $name;
    public $icon;
    //Image
    public $icon_width = 100;
    public $icon_height = 100;

    protected $listeners = [
        'ServicesCreateChange'
    ];
    protected function rules(){
        $rules = [
            'name'=>'required',
            'icon'=>'image|max:2048|nullable'
        ];
        return $rules;
    }
    protected $messages = [
        'name.required'=>'Name is required',
        'icon.max'=>'Your image exceeds 2MB of capacity',
    ];
    public function hydrate(){
        $this->emit('ServicesCreateHydrate');
    }
    public function ServicesCreateChange($value, $key){
        $this->$key = $value;
    }
    public  function closeAndClean(){
        $this->reset([
            'name',
            'icon',
        ]);
        $this->resetValidation([
            'name',
            'icon',
        ]);
    }
    public function save(){
        $this->validate();
        $icon = null;
        if ($this->icon){
            $icon = Str::slug($this->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->icon->getClientOriginalExtension();
            Image::make($this->icon)->resize($this->icon_width,$this->icon_height)->save(public_path('uploads/services/icons/'.$icon,50));
        }
        $service = new Service();
        $service->name = $this->name;
        $service->icon = $icon;
        $service->save();
        $this->emitTo('services.show','render');
        $this->emit('alert',__('Registered Service!'),'#create');
        $this->emit('ServicesShowRender');
        $this->closeAndClean();
    }
    public function render()
    {
        return view('livewire.services.create');
    }
}
