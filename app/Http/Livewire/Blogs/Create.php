<?php

namespace App\Http\Livewire\Blogs;

use App\Models\Blog;
use App\Models\BlogCategory;
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
    //Image
    public $image_width = 240;
    public $image_height = 240;
    //Create
    public $image;
    public $category_id;
    public $title;
    public $description;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    protected $listeners = [
        'BlogsCreateChange',
        'categoriesUpdated'
    ];
    protected function rules(){
        $rules = [
            'image'=>'nullable|image|max:1024',
            'category_id'=>'required',
            'title'=>'required',
            'description'=>'nullable',
        ];
        return $rules;
    }
    protected $messages = [
        'title.required'=>'Title is required',
        'image.max'=>'Your image exceeds 2MB of capacity',
        'category_id.required'=>'Category is required'
    ];
    public function hydrate(){
        $this->emit('BlogsCreateHydrate');
    }
    public function BlogsCreateChange($value, $key){
        $this->$key = $value;
    }
    public function categoriesUpdated(){
        $this->categories = BlogCategory::all();
    }
    public  function closeAndClean(){
        $this->reset([
            'image',
            'category_id',
            'title',
            'description',
        ]);
        $this->resetValidation([
            'image',
            'category_id',
            'title',
            'description',
        ]);
    }
    public function mount(){
        $this->categories = BlogCategory::all();
    }
    public function save(){
        $this->validate();
        $image = null;
        if ($this->image){
            $image = Str::slug($this->title).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image->getClientOriginalExtension();
            Image::make($this->image)->resize($this->image_width,$this->image_height)->save(public_path('uploads/blogs/'.$image,50));
        }
        $blog = new Blog();
        $blog->image = $image;
        $blog->title = $this->title;
        $blog->category_id = $this->category_id;
        $blog->description = $this->description;
        $blog->meta_title = $this->title;
        $blog->meta_description = $this->description;
        $blog->meta_keywords = $this->meta_keywords;
        $blog->save();
        $this->emitTo('blogs.show','render');
        $this->emit('alert',__('Registered Blog!'),'#create');
        $this->emit('BlogsShowRender');
        $this->closeAndClean();
    }
    public function render()
    {
        return view('livewire.blogs.create');
    }
}
