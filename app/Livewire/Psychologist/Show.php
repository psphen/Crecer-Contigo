<?php

namespace App\Livewire\Psychologist;

use App\Models\Psychologist;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    //Edit
    public $psychologist;
    public $person_id;
    public $specialty;
    public $work_days = [];
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
        'PsychologistShowChange',
        'PsychologistShowRender'=>'render'
    ];
    public function hydrate()
    {
        $this->dispatch('PsychologistShowHydrate');
    }
    public function PsychologistShowChange($value, $key)
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
            'specialty' => 'nullable',
        ];

        return $rules;
    }
    public  function chargingData()
    {
        $query = Psychologist::query();

        if ($this->query){
            $query->where('name', 'like', '%' . $this->query . '%');
        }

        $query->orderBy($this->orderBy['field'], $this->orderBy['direction']);

        return $query->paginate($this->cant); 
    }
    public  function edit(Psychologist $psychologist)
    {
        $this->psychologist = $psychologist;
        $this->person_id = $this->psychologist->person;
        $this->specialty = $this->psychologist->specialty;
        $this->is_active = $this->service->is_active;
    }
    public function update()
    {
        $this->psychologist->person_id = $this->perosn_id;
        $this->psychologist->specialty = $this->specialty;
        $this->psychologist->is_active = $this->is_active;
        $this->psychologist->save();
        $this->dispatch('services.show','render');
        $this->dispatch('alert',__('Service updated!'),'#edit');
        $this->dispatch('ServicesShowRender');
    }
    public  function delete(Psychologist $psychologist)
    {
        $this->psychologist = $psychologist;
    }
    public function destroy()
    {
        $this->psychologist->delete();
        $this->dispatchTo('services.show','render');
        $this->dispatch('alert',__('Service deleted!'),'#delete');
        $this->dispatch('ServicesShowRender');
    }
    public function render()
    {
        if ($this->readyToLoad){
            $psychologists = $this->chargingData();
        }else{
            $psychologists = [];
        }

        return view('livewire.psychologist.show', compact('psychologists'));
    }
}
