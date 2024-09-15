<?php

namespace App\Http\Livewire\Subcategories;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    //Create
    public $name;
    public $category_id;
    //Mount
    public $categories;

    protected  $listeners = [
        'SubcategoriesCreateChange'
    ];
    protected function rules()
    {
        $rules = [
            'name' => 'required',
            'category_id' => 'required|exists:categories,id'
        ];
        return $rules;
    }

    protected $messages = [
        'name.required'=>'Name is required',
        'category_id.required'=>'Category is required'
    ];
    public function hydrate(){
        $this->emit('SubcategoriesCreateHydrate');
    }
    public function SubcategoriesCreateChange($value,$key){
        $this->$key = $value;
    }
    public function closeAndClean(){
        $this->reset([
            'name',
            'category_id'
        ]);
        $this->resetValidation([
            'name',
            'category_id'
        ]);
    }
    public  function mount(){
        $this->categories = Category::all();
    }
    public function save(){
        $this->validate();
        $subcategory = new Subcategory();
        $subcategory->name = $this->name;
        $subcategory->category_id = $this->category_id;
        $subcategory->save();
        $this->emitTo('subcategories.show','render');
        $this->emit('alert',__('Registered Subcategory!'),'#create');
        $this->emit('SubcategoriesShowRender');
        $this->closeAndClean();
    }
    public function render()
    {
        return view('livewire.subcategories.create');
    }
}
