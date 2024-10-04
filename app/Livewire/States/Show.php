<?php

namespace App\Livewire\States;

use App\Models\State;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    protected $listeners =[
        'StatesShowChange',
        'StatesShowRender'=>'render'
    ];
    //Query
    public $readyToLoad = false;
    public $maintenance = false;
    public $is_active;
    public $query='';
    public $cant ='10';
    public $file;
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
    public function updatingQuery(){
        $this->resetPage();
    }
    public function hydrate(){
        $this->emit('StatesShowHydrate');
    }
    public function StatesShowChange($value, $key){
        $this->$key = $value;
    }
    public function readyToLoad(){
        $this->readyToLoad= true;
    }
    public function chargingData(){
        $query = State::query();
        if ($this->query){
            $query->where('name', 'like', '%' . $this->query .'%');
        }
        if ($this->is_active !=''){
            $query->where('is_active',$this->is_active);
            $this->resetPage();
        }

        $query->orderBy($this->orderBy['field'], $this->orderBy['direction']);
        return $query->paginate($this->cant);
    }
    public function render()
    {
        if ($this->readyToLoad){
            $states = $this->chargingData();
        }else{
            $states = [];
        }
        return view('livewire.states.show',compact('states'));
    }
}
