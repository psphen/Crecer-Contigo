<?php

namespace App\Http\Livewire\Posts;

use App\Models\Category;
use App\Models\Place;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Image;
class Show extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $listeners = [
        'PostsShowChange',
        'PostsShowRender'=>'render'
    ];
    //Mount
    public $places;
    public $categories;
    //Edit
    public $post;
    public $post_image;
    public $image;
    //Image
    public $image_width = 400;
    public $image_height = 400;
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
    public function updatingQuery(){
        $this->resetPage();
    }
    public  function hydrate(){
        $this->emit('PostsShowHydrate');
    }
    public function PostsShowChange($value, $key){
        $this->$key = $value;
    }
    public function readyToLoad(){
        $this->readyToLoad= true;
    }
    public function mount(){
        $this->places = Place::all();
        $this->categories = Category::all();
    }
    public function chargingData(){
        $query = Post::query();
        if ($this->query){
            $query->where('name', 'like', '%' . $this->query .'%');
        }
        $query->orderBy($this->orderBy['field'], $this->orderBy['direction']);
        return $query->paginate($this->cant);
    }
    protected function rules(){
        $rules = [
            'post.place_id'=>'',
            'post.category_id'=>'',
            'post.name'=>'',
            'post.price'=>'',
            'post.content'=>'',
            'post.is_feature'=>'',
            'post.best_selling'=>'',
            'post.is_active'=>''
        ];
        return $rules;
    }
    public function edit(Post $post){
        $this->post = $post;
        $this->post_image = $this->post->image;
    }
    public function update(){
        if ($this->image){
            File::delete(public_path('uploads/posts/'.$this->post->image));
            $image = Str::slug($this->post->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image->getClientOriginalExtension();
            Image::make($this->image)->resize($this->image_width, $this->image_height)->save(public_path('uploads/posts/' . $image, 50));
        }else{
            $image = $this->post->image;
        }
        $this->post->image = $image;
        $this->post->save();
        $this->emitTo('posts.show','render');
        $this->emit('alert',__('Post updated!'),'#edit');
        $this->emit('PostsShowRender');
    }
    public function delete(Post $post){
        $this->post = $post;
        $this->post_image = $this->post->image;
    }
    public function destroy(){
        File::delete(public_path('uploads/posts/'.$this->post->image));
        $this->post->delete();
        $this->emitTo('posts.show','render');
        $this->emit('alert',__('Post deleted!'),'#delete');
        $this->emit('PostsShowRender');
    }
    public function render()
    {
        if ($this->readyToLoad){
            $posts = $this->chargingData();
        }else{
            $posts = [];
        }
        return view('livewire.posts.show',compact('posts'));
    }
}
