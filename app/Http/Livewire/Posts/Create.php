<?php

namespace App\Http\Livewire\Posts;

use App\Models\Category;
use App\Models\Place;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;

class Create extends Component
{
    use WithFileUploads;
    //Mount
    public $categories;
    public $places;
    //Image
    public $image_width = 400;
    public $image_height = 400;
    //Create
    public $place_id;
    public $category_id;
    public $image;
    public $name;
    public $price;
    public $content;
    public $is_feature = false;
    public $best_selling = false;
    public $is_active = true;
    protected $listeners = [
        'PostsCreateChange'
    ];
    protected function rules(){
        $rules = [
            'place_id'=>'required',
            'category_id'=>'required',
            'image'=>'nullable|image|max:1024',
            'name'=>'required',
            'price'=>'required',
            'content'=>'nullable',
            'is_feature'=>'nullable',
            'best_selling'=>'nullable',
            'is_active'=>'nullable'
        ];
        return $rules;
    }
    protected $messages = [
        'place_id.required'=>'Place is required',
        'category_id.required'=>'Category is required',
        'name.required'=>'Name is required',
        'price.required'=>'Price is required',
    ];
    public function hydrate(){
        $this->emit('PostsCreateHydrate');
    }
    public function PostsCreateChange($value, $key){
        $this->$key = $value;
    }
    public  function closeAndClean(){
        $this->reset([
            'place_id',
            'category_id',
            'image',
            'name',
            'price',
            'content',
            'is_feature',
            'best_selling',
            'is_active'
        ]);
        $this->resetValidation([
            'place_id',
            'category_id',
            'image',
            'name',
            'price',
            'content',
            'is_feature',
            'best_selling',
            'is_active'
        ]);
    }
    public  function mount(){
        $this->places = Place::all();
        $this->categories = Category::all();
    }
    public function save(){
        $this->validate();
        $image = null;
        if ($this->image){
            $image = Str::slug($this->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image->getClientOriginalExtension();
            Image::make($this->image)->resize($this->image_width,$this->image_height)->save(public_path('uploads/posts/'.$image,50));
        }
        $post = new Post();
        $post->place_id = $this->place_id;
        $post->category_id = $this->category_id;
        $post->image = $image;
        $post->name = $this->name;
        $post->price = $this->price;
        $post->content = $this->content;
        $post->is_feature = $this->is_feature;
        $post->best_selling =$this->best_selling;
        $post->is_active = $this->is_active;
        $post->save();
        $this->emitTo('posts.show','render');
        $this->emit('alert',__('Registered Post!'),'#create');
        $this->emit('PostsShowRender');
        $this->closeAndClean();
    }
    public function render()
    {
        return view('livewire.posts.create');
    }
}
