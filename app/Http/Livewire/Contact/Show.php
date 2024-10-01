<?php

namespace App\Http\Livewire\Contact;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $readyToLoad = false;
    public $query='';
    public $cant ='10';
    protected $listeners = [
        'ServicesShowChange',
        'ServicesShowRender'=>'render'
    ];
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

    public function readyToLoad()
    {
        $this->readyToLoad= true;
    }
    public  function hydrate()
    {
        $this->emit('ServicesShowHydrate');
    }
    public function ServicesShowChange($value, $key)
    {
        $this->$key = $value;
    }
    public  function chargingData()
    {
        $query= Contact::query();
        if ($this->query){
            $query->where('name', 'like', '%' . $this->query . '%');
        }

        $query->orderBy($this->orderBy['field'], $this->orderBy['direction']);

        return $query->paginate($this->cant);
    }
    public function render()
    {
        if ($this->readyToLoad){
            $contacts = $this->chargingData();
        }else{
            $contacts = [];
        }

        return view('livewire.contact.show', compact('contacts'));
    }
}
