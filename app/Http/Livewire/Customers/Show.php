<?php

namespace App\Http\Livewire\Customers;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $listeners = [
        'CustomersShowChange',
        'CustomersShowRender'=>'render'
    ];
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
        'first_name' => 'Name',
    ];
    public function updatingQuery(){
        $this->resetPage();
    }
    public  function hydrate(){
        $this->emit('CustomersShowHydrate');
    }
    public function CustomersShowChange($value, $key){
        $this->$key = $value;
    }
    public function readyToLoad(){
        $this->readyToLoad= true;
    }
    public function chargingData(){
        $query = Customer::query();
        if ($this->query) {
            $query->where('first_name', 'like', '%' . $this->query . '%');
            $query->orWhere('last_name', 'like', '%' . $this->query . '%');
        }
        $query->orderBy($this->orderBy['field'],$this->orderBy['direction']);
        return $query->paginate($this->cant);
    }
    public function render()
    {
        if ($this->readyToLoad){
            $customers = $this->chargingData();
        }else{
            $customers = [];
        }
        return view('livewire.customers.show',compact('customers'));
    }
}
