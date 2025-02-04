<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\CartItems;
use App\Models\Service;

class Pedido extends Component
{
    public $readyToLoad = false;
    public $query = '';
    public $cant ='10';
    public $cartCount = 0;
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
    public function mount()
    {
        $this->cartCount = CartItems::count();
    }
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
    public function addToCart($serviceId)
    {
        CartItems::create(['service_id' => $serviceId]);

        $this->cartCount = CartItems::count();

        $this->dispatch('cartUpdated', $this->cartCount);
    }
    public function chargingData()
    {
        $query = Service::query();

        if ($this->query){
            $query->where('name', 'like', '%' . $this->query . '%');
        }

        $query->orderBy($this->orderBy['field'], $this->orderBy['direction']);

        return $query->paginate($this->cant); 
    }
    public function render()
    {
        if ($this->readyToLoad){
            $services = $this->chargingData();
        }else{
            $services = [];
        }

        return view('livewire.frontend.pedido', compact('services'));
    }
}
