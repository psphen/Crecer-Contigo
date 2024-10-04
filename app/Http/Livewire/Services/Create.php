<?php

namespace App\Http\Livewire\Services;

use App\Models\Service;
use Livewire\Component;

class Create extends Component
{
    //Create
    public $name;
    public $description;
    public $costo;
    public $sections;
    public $is_active;

    protected $listeners = [
        'ServicesCreateChange'
    ];
    public function hydrate()
    {
        $this->emit('ServicesCreateHydrate');
    }
    public function ServicesCreateChange($value, $key)
    {
        $this->$key = $value;
    }
    protected function rules()
    {
        $rules = [
            'name'=>'required',
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
        ]);
        $this->resetValidation([
            'name',
        ]);
    }
    public function save()
    {
        $this->validate();

        $service = new Service();
        $service->name = $this->name;
        $service->description = $this->description; 
        $service->costo = $this->costo;
        $service->sections = $this->sections;
        $service->is_active = 1;
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
