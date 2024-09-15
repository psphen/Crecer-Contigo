<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Category;
use App\Models\Place;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    public $query;
    public $categorySlug;
    public $category;
    public $posts;

    public function mount($categorySlug){
        $this->categorySlug = $categorySlug;
        $this->category =Category::where('slug',$this->categorySlug)->first();
        $this->posts = Post::where('category_id', $this->category->id)->get();
    }
    public function filterProduct(){
        $query = Place::query();
        if ($this->query) {
            $query->where('name', 'like', '%' . $this->query . '%');
            $this->resetPage();
        }

        return $query->whereHas('posts', function ($query) {
            $query->where('category_id', $this->category->id);
        });
    }
    public function render()
    {
        $results = $this->filterProduct()->paginate(10);

        return view('livewire.frontend.categories',compact('results'));
    }
}
