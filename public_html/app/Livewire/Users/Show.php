<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Show extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $listeners = [
        'SubcategoriesShowChange',
        'SubcategoriesShowRender'=>'render'
    ];
    //Mount
    public $roles;
    //Show
    public $readyToLoad = false;
    public $maintenance = false;
    public $query='';
    public $cant = '10';
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
    //Edit
    public $user;
    public $password;
    public $selectedRoles;
    public function updatingQuery(){
        $this->resetPage();
    }
    public  function hydrate(){
        $this->emit('UsersShowHydrate');
    }
    public function UsersShowChange($value, $key){
        $this->$key = $value;
    }
    public function readyToLoad(){
        $this->readyToLoad= true;
    }
    public function mount(){
        $this->roles = Role::whereIn('name', ['Admin', 'Editor'])->get();
    }
    public function chargingData(){
        $query = User::query();
        if ($this->query){
            $query->where('name', 'like', '%' . $this->query . '%');
        }
        $query->orderBy($this->orderBy['field'], $this->orderBy['direction']);
        return $query->paginate($this->cant);
    }
    //Edit
    protected function rules(){
        $rules = [
            'user.name'=>'required',
            'user.email'=>'required|unique:users|email',
        ];
        return $rules;
    }
    public function edit(User $user){
        $this->user = $user;
        $this->selectedRoles = $user->roles->pluck('id')->toArray();

    }
    public function update(){
        if ($this->password){
            $this->user->password = bcrypt($this->password);
        }
        $this->user->roles()->sync($this->selectedRoles);

        $this->user->save();

        $this->emitTo('users.show','render');
        $this->emit('alert',__('Updated User!'),'#edit');
        $this->emit('UsersShowRender');
    }
    public function delete(User $user){
        $this->user = $user;

    }
    public function destroy(){
        $this->user->delete();
        $this->emitTo('users.show','render');
        $this->emit('alert',__('Deleted User!'),'#delete');
        $this->emit('UsersShowRender');
    }
    public function render()
    {
        if ($this->readyToLoad){
            $users = $this->chargingData();
        }else{
            $users = [];
        }
        return view('livewire.users.show',compact('users'));
    }
}
