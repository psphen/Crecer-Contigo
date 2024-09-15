<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Category;
use App\Models\City;
use App\Models\Place;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
class Search extends Component
{
    use WithPagination;
    // Query
    public $category;
    public $query;

    public $parameters;
    public $cant =9;

    protected $queryString =[
        'cant'=>['except'=>9],
        'query'=>['except'=>''],
        'category'=>['except'=>'']
    ];
    public function updatingQuery(){
        $this->resetPage();
    }
    public function mount($resultQuery)
    {
        $this->query = $resultQuery;
//        $this->category = $resultCategory;
//        $this->parameters =[
//            ['id' => 1, 'name' => 'Categories'],
//            ['id' => 2, 'name' => 'Cities'],
//            ['id' => 3, 'name' => 'Places'],
//            ['id' => 4, 'name' => 'Posts'],
//        ];

    }
    public function Categories(){
        $categories = Category::query();
      if ($this->query){
          $categories->where('name', 'like', '%' . $this->query . '%');
      }
      return $categories->paginate($this->cant);

    }
    public function Cities(){
        $result_cities = City::query();
        if ($this->query){
            $result_cities->where('name', 'like', '%' . $this->query . '%');
        }
        return $result_cities->paginate($this->cant);

    }
    public function Places(){
        $places = Place::query();
        if ($this->query){
            $places->where('name', 'like', '%' . $this->query . '%');
        }
        return $places->paginate($this->cant);

    }
    public function Posts(){
        $posts = Post::query();
        if ($this->query){

            $posts->where('name', 'like', '%' . $this->query . '%');
        }
        return $posts->paginate($this->cant);

    }
    public function render()
    {
        $categories= $this->Categories();
        $result_cities = $this->Cities();
        $places = $this->Places();
        $posts = $this->Posts();
        return view('livewire.frontend.search',compact('categories','result_cities','places','posts'));
    }
}
