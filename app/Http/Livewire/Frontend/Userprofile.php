<?php

namespace App\Http\Livewire\Frontend;

use App\Models\User;
use App\Models\Post;
use App\Models\Place;
use Livewire\WithPagination;
use Livewire\Component;

class Userprofile extends Component
{
    use WithPagination;

    public $user;
    protected $posts;
    public $places;

    public function mount($userprofileId)
    {
        $this->userprofileId = $userprofileId;
        $this->user = User::findOrFail($userprofileId);
        $this->places = Place::all();
        $this->loadPosts();
    }
    public function render()
    {
        $this->loadPosts();

        return view('livewire.frontend.userprofile', ['posts' => $this->posts]);
    }
    protected function loadPosts()
    {
        // Cambiar la dirección de ordenamiento para obtener los últimos posts primero
        $this->posts = Post::whereHas('place', function ($query) {
            $query->where('user_id', $this->user->id);
        })->paginate(4);
    }
}
