<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;
class Create extends Component
{
    use WithFileUploads;
    //Create
    public $name;
    public $priority;
    public $icon;
    //Image
    public $icon_width = 100;
    public $icon_height = 100;

    protected $listeners = [
        'CategoriesCreateChange'
    ];
    protected function rules(){
        $rules = [
            'name'=>'required',
            'priority'=>'nullable',
            'icon'=>'image|max:2048|nullable',
        ];
        return $rules;
    }
    protected $messages = [
        'name.required'=>'Name is required',
        'icon.max'=>'Your image exceeds 2MB of capacity',
    ];
    public function hydrate(){
        $this->emit('CategoriesCreateHydrate');
    }
    public function CategoriesCreateChange($value, $key){
        $this->$key = $value;
    }
    public  function closeAndClean(){
        $this->reset([
            'name',
            'icon',
            'priority',
        ]);
        $this->resetValidation([
            'name',
            'icon',
            'priority',
        ]);
    }
    public function mount(){

    }

    public function save(){
        $this->validate();
        $icon = null;
        if ($this->icon){
            $icon = Str::slug($this->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->icon->getClientOriginalExtension();
            Image::make($this->icon)->resize($this->icon_width,$this->icon_height)->save(public_path('uploads/categories/icons/'.$icon,50));
        }
        $category = new Category();
        $category->name = $this->name;
        $category->icon = $icon;
        $category->priority = $this->priority;
        $category->save();
        $this->emitTo('categories.show','render');
        $this->emit('alert',__('Registered Category!'),'#create');
        $this->emit('CategoriesShowRender');
        $this->closeAndClean();
    }
    public function render()
    {
        return view('livewire.categories.create');
    }
}
