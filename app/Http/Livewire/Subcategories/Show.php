<?php

namespace App\Http\Livewire\Subcategories;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Show extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $listeners = [
        'SubcategoriesShowChange',
        'SubcategoriesShowRender'=>'render'
    ];
    //Edit
    public $subcategory;
    //Mount
    public $categories;
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
    public function updatingQuery(){
        $this->resetPage();
    }
    public  function hydrate(){
        $this->emit('SubcategoriesShowHydrate');
    }
    public function SubcategoriesShowChange($value, $key){
        $this->$key = $value;
    }
    public function readyToLoad(){
        $this->readyToLoad= true;
    }
    public function mount(){
        $this->categories = Category::all();
    }
    public  function chargingData(){
        $query = Subcategory::query();
        if ($this->query){
            $query->where('name', 'like', '%' . $this->query . '%');
        }
        $query->orderBy($this->orderBy['field'], $this->orderBy['direction']);
        return $query->paginate($this->cant);
    }
    protected function rules()
    {
        $rules = [
            'subcategory.name' => 'required',
            'subcategory.category_id' => 'required|exists:categories,id'
        ];
        return $rules;
    }
    public function edit(Subcategory $subcategory){
        $this->subcategory = $subcategory;
    }
    public function update(){
        $this->subcategory->save();
        $this->emitTo('subcategories.show','render');
        $this->emit('alert',__('Updated Subcategory!'),'#edit');
        $this->emit('SubcategoriesShowRender');
    }
    public function delete(Subcategory $subcategory){
        $this->subcategory = $subcategory;
    }
    public function destroy(){
        $this->subcategory->delete();
        $this->emitTo('subcategories.show','render');
        $this->emit('alert',__('Deleted Subcategory!'),'#delete');
        $this->emit('SubcategoriesShowRender');
    }
    public function render()
    {
        if ($this->readyToLoad){
            $subcategories = $this->chargingData();
        }else{
            $subcategories = [];
        }
        return view('livewire.subcategories.show',compact('subcategories'));
    }
}
