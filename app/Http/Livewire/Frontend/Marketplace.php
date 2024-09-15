<?php

namespace App\Http\Livewire\Frontend;

use App\Models\LikePost;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Place;
use App\Models\Visitor;
use App\Models\Vendor;
use App\Models\Customer;
use App\Models\CommentsPost;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Image;

class Marketplace extends Component
{
    use WithPagination;
    use WithFileUploads;

    //Mount
    public $categories;
    public $places;
    public $user;
    public $newComment;
    public $post;
    public $post_id;
//    protected $posts;
    public $image;
    public $image_width = 300;
    public $image_height = 200;
    //Create
    public $place_id;
    public $category_id;
    public $name;
    public $price;
    public $content;
    public $is_feature = false;
    public $best_selling = false;
    public $showAllComments = false;
    public $is_active = true;
    public $perPage = 5;
    public $loadMore = 5;
    public $totalPosts;
    public $showLoadMoreButton = true;
    public $query;
    protected $listeners = [
        'PostsCreateChange',
        'PostsShowChange',
        'PostsShowRender'=>'render'
    ];
    protected function rules(){
        $rules = [
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
        'category_id.required'=>'Category is required',
        'name.required'=>'Name is required',
        'price.required'=>'Price is required',
    ];
    public function hydrate()
    {
        $this->emit('PostsCreateHydrate');
    }
    public function PostsCreateChange($value, $key)
    {
        $this->$key = $value;
    }
    public  function closeAndClean()
    {
        $this->reset([
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
    public function mount()
    {
        $this->user = Auth::user();
        $this->places = Place::all();
        $this->categories = Category::all();
        $this->totalPosts = Post::count();
//        dd($this->totalPosts);
    }
    public function loadMorePosts()
    {
        $this->perPage += 5;

        if ($this->perPage >= $this->totalPosts) {
            $this->showLoadMoreButton = false;
            $this->render();
        }
    }
    public function save()
    {
        $this->validate();
        $user = Auth::user();
        $place = $user->place;
        $image = null;
        if ($this->image){
            $image = Str::slug($this->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image->getClientOriginalExtension();
            Image::make($this->image)->resize($this->image_width,$this->image_height)->save(public_path('uploads/posts/'.$image,50));
        }
        $post = new Post();
        $post->category_id = $this->category_id;
        $post->place_id = $place->id;
        $post->image = $image;
        $post->name = $this->name;
        $post->price = $this->price;
        $post->content = $this->content;
        $post->is_feature = $this->is_feature;
        $post->best_selling =$this->best_selling;
        $post->is_active = $this->is_active;
        $post->save();
        $this->emit('closeModal');
        $this->closeAndClean();
    }
    public function render()
    {
        $posts = $this->loadPosts(); // Cargar los posts antes de renderizar la vista
        $commentCount = [];

        foreach ($posts as $post) {
            $commentCount[$post->id] = count($post->comments);
        }
        return view('livewire.frontend.marketplace', compact('posts', 'commentCount'));
    }
    protected function loadPosts()
    {
        // Cambiar la dirección de ordenamiento para obtener los últimos posts primero
        $query = Post::query();
        if ($this->query) {
            $query->where('posts.name', 'like', '%' . $this->query . '%');
        }

        $posts = $query
            ->select('posts.*')
            ->join('places', 'posts.place_id', '=', 'places.id')
            ->join('users', 'places.user_id', '=', 'users.id')
            ->orderBy('posts.created_at', 'desc')
            ->orderBy('users.id')
            ->paginate($this->perPage);

        return $posts;
    }
    public function toggleComments()
    {
        $this->showAllComments = !$this->showAllComments;
    }
    public function addComment($postId)
    {
        $this->validate([
            'newComment' => 'required|min:3',
        ]);

        CommentsPost::create([
            'user_id' => auth()->user()->id,
            'post_id' => $postId, // Usar el identificador del post pasado como parámetro
            'comment' => $this->newComment,
        ]);

        $this->newComment = '';
    }
    public function toggleLike($postId)
    {
        $user = Auth::user();
        $like = LikePost::where('user_id', $user->id)->where('post_id', $postId)->first();

        if ($like) {
            // Si el usuario ya dio "Me gusta," eliminamos el registro
            $like->delete();
        } else {
            // Si el usuario no dio "Me gusta," creamos un nuevo registro
            LikePost::create([
                'user_id' => $user->id,
                'post_id' => $postId,
            ]);
        }
    }
}
