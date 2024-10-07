<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    //Edit
    public $service;
    public $name;
    public $image;
    public $description;
    public $price;
    public $sections;
    public $is_active = true;

    //Init
    public $readyToLoad = false;

    //Search
    #[Url(as: 'q')]
    public $query = '';
    public $cant ='10';

    public $orderBy = [
        'field' => 'created_at',
        'direction' => 'asc',
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
    public function hydrate()
    {
        $this->dispatch('ServicesShowHydrate');
    }
    public function ServicesShowChange($value, $key)
    {
        $this->$key = $value;
    }
    public function updatingQuery()
    {
        $this->resetPage();
    }
    public function loadView()
    {
        $this->readyToLoad = true;
    }
    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:1024',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_in_months' => 'required|integer|min:1',
            'is_active' => 'required|boolean'
        ];

        return $rules;
    }
    public  function chargingData()
    {
        $query = Service::query();

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
        $this->price = $this->service->prince;
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
        $this->dispatchTo('services.show','render');
        $this->dispatch('alert',__('Service updated!'),'#edit');
        $this->dispatch('ServicesShowRender');
    }
    public  function delete(Service $service)
    {
        $this->service = $service;
    }
    public function destroy()
    {
        $this->service->delete();
        $this->dispatchTo('services.show','render');
        $this->dispatch('alert',__('Service deleted!'),'#delete');
        $this->dispatch('ServicesShowRender');
    }
    public function render()
    {
        if ($this->readyToLoad){
            $services = $this->chargingData();
        }else{
            $services = [];
        }

        return view('livewire.service.show', compact('services'));
    }
}
