<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Image;

class Show extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'CategoriesShowChange',
        'CategoriesShowRender'=>'render'
    ];

    //Mount
    public $parent_categories;
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
        'name' => 'Name',
    ];
    //Edit
    public $category;
    public $icon;
    public $icon_edit;
    //Image
    public $icon_width = 100;
    public $icon_height = 100;
    public function updatingQuery(){
        $this->resetPage();
    }
    public  function hydrate(){
        $this->emit('CategoriesShowHydrate');
    }
    public function CategoriesShowChange($value, $key){
        $this->$key = $value;
    }
    public function readyToLoad(){
        $this->readyToLoad= true;
    }
    public function mount(){
        $this->parent_categories = Category::all();
    }
    public  function chargingData(){
        $query = Category::query();
        if ($this->query){
            $query->where('name', 'like', '%' . $this->query . '%');
        }
        $query->orderBy($this->orderBy['field'], $this->orderBy['direction']);
        return $query->paginate($this->cant);
    }
    //Edit
    protected function rules(){
        $rules = [
            'category.name'=>'required',
            'category.priority'=>'nullable',
            'icon'=>'image|max:2048|nullable',
//            'category.category_id'=>'nullable'
        ];
        return $rules;
    }
    public function edit(Category $category){
        $this->category = $category;
        $this->icon_edit = $this->category->icon;
    }
    public function update(){
        if ($this->icon){
            File::delete(public_path('uploads/categories/icons/'.$this->category->icon));
            $icon = Str::slug($this->category->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->icon->getClientOriginalExtension();
            Image::make($this->icon)->resize($this->icon_width, $this->icon_height)->save(public_path('uploads/categories/icons/' . $icon, 50));
        }else{
            $icon = $this->category->icon;
        }
        $this->category->icon = $icon;
        $this->category->save();
        $this->emitTo('categories.show','render');
        $this->emit('alert',__('Category updated!'),'#edit');
        $this->emit('CategoriesShowRender');
        $this->emit('CategoriesCreateRender');
    }
    public function delete(Category $category){
        $this->category = $category;
    }
    public function destroy(){
        File::delete(public_path('uploads/categories/icons/'.$this->category->icon));
        $this->category->delete();
        $this->emitTo('categories.show','render');
        $this->emit('alert',__('Category deleted!'),'#delete');
        $this->emit('CategoriesShowRender');
        $this->emit('CategoriesCreateRender');
    }
    public function render()
    {
        if ($this->readyToLoad){
            $categories = $this->chargingData();
        }else{
            $categories = [];
        }
        return view('livewire.categories.show',compact('categories'));
    }
}
