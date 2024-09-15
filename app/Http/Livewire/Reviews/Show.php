<?php

namespace App\Http\Livewire\Reviews;

use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    protected $listeners = [
        'ReviewsShowChange',
        'ReviewsShowRender'=>'render'
    ];
    //Init
    public $readyToLoad = false;
    public $maintenance = false;
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
    ];
    public function updatingQuery(){
        $this->resetPage();
    }
    public  function hydrate(){
        $this->emit('ReviewsShowHydrate');
    }
    public function ReviewsShowChange($value, $key){
        $this->$key = $value;
    }
    public function readyToLoad(){
        $this->readyToLoad= true;
    }
    public function chargingData(){
        $reviews = Review::where(function ($query){
            if ($this->query){
                $query->whereHas('user',function ($userQuery){
                    $userQuery->where('name', 'like', '%' . $this->query . '%');
                });
                $query->orWhereHas('place',function ($placeQuery){
                    $placeQuery->where('name', 'like', '%' . $this->query . '%');
                });
            }
        });
        $reviews->orderBy($this->orderBy['field'], $this->orderBy['direction']);
        return $reviews->paginate($this->cant);
    }
    public function render()
    {
        if ($this->readyToLoad){
            $reviews = $this->chargingData();
        }else{
            $reviews = [];
        }
        return view('livewire.reviews.show',compact('reviews'));
    }
}
