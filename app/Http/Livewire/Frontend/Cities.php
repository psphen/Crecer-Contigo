<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Category;
use App\Models\City;
use App\Models\Place;
use App\Models\PlaceType;
use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
class Cities extends Component
{
    use WithPagination;
    public $query;
    public $citySlug;
    public $city;

    public $types;
    public $services;
    public $categories;


    public $typeSelected = [];
    public $categorySelected = [];
    public $serviceSelected = [];

    public function mount($citySlug){
        $this->citySlug = $citySlug;
        $this->city =City::where('slug',$this->citySlug)->first();
        $this->types = PlaceType::all();
        $this->categories = Category::all();
        $this->services = Service::all();
    }
    public function filterPlace(){
        $query = Place::query();
        if ($this->query) {
            $query->where('name', 'like', '%' . $this->query . '%');
            $this->resetPage();
        }
        if (!empty($this->typeSelected)) {
            $query->whereIn('type_id', $this->typeSelected);
            $this->resetPage();
        }
        if (!empty($this->categorySelected)) {
            $query->whereHas('categories', function ($query) {
                $query->whereIn('categories.id', $this->categorySelected);
            });
            $this->resetPage();
        }
        if (!empty($this->serviceSelected)) {
            $query->whereHas('services', function ($query) {
                $query->whereIn('services.id', $this->serviceSelected);
            });
            $this->resetPage();
        }
        return $query->where('city_id', $this->city->id);
    }
    public function render()
    {
        $results = $this->filterPlace()->paginate(6);
        $places  = $this->filterPlace()->get();
        $this->dispatchBrowserEvent('updateMap', $places->toArray());
        return view('livewire.frontend.cities',compact('results','places'));
    }
}
