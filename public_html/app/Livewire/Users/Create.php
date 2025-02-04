<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    use WithFileUploads;
    //Mount
    public $roles;
    //Create
    public $name;
    public $role;
    public $email;
    public $password;

    protected $listeners = [
        'UsersCreateChange'
    ];

    protected function rules(){
        $rules = [
            'name'=>'required',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:8',
            'role'=>'required'
        ];
        return $rules;
    }
    protected $messages = [
        'name.required'=>'Name is required',
        'email.required'=>'Email is required',
        'email.unique'=>'Email already exists',
        'email.email'=>'Email must be a valid email address',
        'password.required'=>'Password is required',
        'password.min'=>'Password requires minimum :min characters',
        'role.required'=>'Role is required',
    ];
    public function hydrate(){
        $this->emit('UsersCreateHydrate');
    }
    public function UsersCreateChange($value, $key){
        $this->$key = $value;
    }
    public function closeAndClean(){
        $this->reset([
            'name',
            'email',
            'password',
            'role',
        ]);
        $this->resetValidation([
            'name',
            'email',
            'password',
            'role',
        ]);
    }
    public function mount(){
        $this->roles = Role::whereIn('name', ['Admin', 'Editor'])->get();
    }
    public function save(){
        $this->validate();
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->save();
        $user->roles()->sync($this->role);
        $this->emitTo('users.show','render');
        $this->emit('alert',__('Registered User!'),'#create');
        $this->emit('UsersShowRender');
        $this->closeAndClean();
    }
    public function render()
    {
        return view('livewire.users.create');
    }
}
