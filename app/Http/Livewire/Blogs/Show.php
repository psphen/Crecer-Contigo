<?php

namespace App\Http\Livewire\Blogs;

use App\Models\Blog;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Show extends Component
{
     use WithFileUploads;
     use WithPagination;
    protected $listeners =[
        'BlogsShowChange',
        'BlogsShowRender'=>'render'
    ];
    //Edit
    public $blog;
    public $blog_image;
    //Image
    public $image_width = 240;
    public $image_height = 240;
    //Create
    public $image;
    //Mount
    public $categories;
    //Categories
    public $addCategories;
    //Query
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
    public function updatingQuery(){
        $this->resetPage();
    }
    public function hydrate(){
        $this->emit('BlogsShowHydrate');
    }
    public function BlogsShowChange($value, $key){
        $this->$key = $value;
    }

    public function readyToLoad(){
        $this->readyToLoad= true;
    }
    public function mount(){
        $this->categories = BlogCategory::all();
        $this->addCategories = $this->categories->toArray();
    }
    public function addCategories()
    {
        $newCategory = ['id' => null, 'name' => ''];
        $this->addCategories[] = $newCategory;
    }

    public function updateCategories()
    {
        $existingCategories = BlogCategory::pluck('name', 'id')->toArray();
        foreach ($this->addCategories as $categoryData) {
            if (!empty($categoryData['name'])) {
                if (isset($existingTypes[$categoryData['id']])) {
                    $category = BlogCategory::find($categoryData['id']);
                    $category->name = $categoryData['name'];
                    $category->save();
                } elseif (in_array($categoryData['name'], $existingCategories)) {
                    continue;
                } else {
                    $category = new BlogCategory();
                    $category->name = $categoryData['name'];
                    $category->save();
                }
            }
        }
        $this->addCategories = [];
        $this->mount();
        $this->emitTo('blogs.categories', 'render');
        $this->emit('alert', __('Updated Categories!'), '#categories');
        $this->emit('BlogsShowRender');
        $this->emit('BlogsCreateRender');
        $this->emit('categoriesUpdated');
    }

    public function removeCategories($index)
    {
        $category = BlogCategory::find($this->addCategories[$index]['id']);
        if ($category) {
            $category->delete();
        }
        unset($this->addCategories[$index]);
        $this->addCategories = array_values($this->addCategories);
    }
    public  function chargingData(){
        $query = Blog::query();
        if ($this->query){
            $query->where('title', 'like', '%' . $this->query .'%');
        }
        $query->orderBy($this->orderBy['field'], $this->orderBy['direction']);
        return $query->paginate($this->cant);
    }
    //Edit
    protected function rules(){
        $rules = [
            'image'=>'nullable|image|max:1024',
            'blog.category_id'=>'',
            'blog.title'=>'',
            'blog.description'=>'',
            'blog.meta_keywords'=>'',
        ];
        return $rules;
    }
    public function edit(Blog $blog){
        $this->blog = $blog;
        $this->blog_image = $this->blog->image;
    }
    public function update(){
        if ($this->image){
            File::delete(public_path('uploads/blogs/'.$this->blog->image));
            $image = Str::slug($this->blog->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image->getClientOriginalExtension();
            Image::make($this->image)->resize($this->image_width, $this->image_height)->save(public_path('uploads/blogs/' . $image, 50));
        }else{
            $image = $this->blog->image;
        }
        $this->blog->image = $image;
        $this->blog->save();
        $this->emitTo('blogs.show','render');
        $this->emit('alert',__('Blog updated!'),'#edit');
        $this->emit('BlogsShowRender');
    }
    public function delete(Blog $blog){
        $this->blog = $blog;
    }
    public function destroy(){
        File::delete(public_path('uploads/blogs/'.$this->blog->image));
        $this->blog->delete();
        $this->emitTo('blogs.show','render');
        $this->emit('alert',__('Blog deleted!'),'#delete');
        $this->emit('BlogsShowRender');
    }
    public function render()
    {
        if ($this->readyToLoad){
            $blogs = $this->chargingData();
        }
        else{
            $blogs = [];
        }
        return view('livewire.blogs.show', compact('blogs'));
    }
}
