<?php

namespace App\Livewire\Services;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    //Edit
    public $service;
    public $name;
    public $description;
    public $costo;
    public $sections;
    public $is_active;

    //Init
    public $readyToLoad = false;
    public $maintenance = false;
    public $query='';
    public $cant ='10';

    public $orderBy = [
        'field' => 'created_at',
        'direction' => 'asc',
    ];
    protected $queryString =[
        'cant'=>['except'=>'10'],
        'query'=>['except'=>'']
    ];
    public $orderByOptions = [
        'created_at' => 'Date of creation',
        'updated_at'=>'Date of updated',
        'name' => 'Name',
    ];
    protected $listeners = [
        'ServicesShowChange',
        'ServicesShowRender'=>'render'
    ];
    public  function hydrate()
    {
        $this->emit('ServicesShowHydrate');
    }
    public function ServicesShowChange($value, $key)
    {
        $this->$key = $value;
    }
    public function updatingQuery()
    {
        $this->resetPage();
    }
    public function readyToLoad()
    {
        $this->readyToLoad= true;
    }
    protected function rules()
    {
        $rules = [
            'service.name'=>'required',
            'icon'=>'image|max:2048|nullable',
        ];
        return $rules;
    }
    public  function chargingData()
    {
        $query= Service::query();
        if ($this->query){
            $query->where('name', 'like', '%' . $this->query . '%');
        }

        $query->orderBy($this->orderBy['field'], $this->orderBy['direction']);

        return $query->paginate($this->cant);
    }
    public  function edit(Service $service)
    {
        $this->service = $service;
        $this->name = $this->service->name;
        $this->description = $this->service->description;
        $this->costo = $this->service->costo;
        $this->sections = $this->service->sections;
        $this->is_active = $this->service->is_active;
    }
    public function update()
    {
        $this->service->name = $this->name;
        $this->service->description = $this->description;
        $this->service->costo = $this->costo;
        $this->service->sections = $this->sections;
        $this->service->is_active = $this->is_active;
        $this->service->save();
        $this->emitTo('services.show','render');
        $this->emit('alert',__('Service updated!'),'#edit');
        $this->emit('ServicesShowRender');
    }
    public  function delete(Service $service)
    {
        $this->service = $service;
    }
    public function destroy()
    {
        $this->service->delete();
        $this->emitTo('services.show','render');
        $this->emit('alert',__('Service deleted!'),'#delete');
        $this->emit('ServicesShowRender');
    }
    public function render()
    {
        if ($this->readyToLoad){
            $services = $this->chargingData();
        }else{
            $services = [];
        }

        return view('livewire.services.show',compact('services'));
    }
}
