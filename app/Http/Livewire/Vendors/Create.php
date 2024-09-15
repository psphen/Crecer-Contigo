<?php

namespace App\Http\Livewire\Vendors;

use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;

class Create extends Component
{
    use WithFileUploads;

    public $user_name;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $phone;
    public $user_id;
    public $dni;
    //Image
    public $image;
    public $image_width = 300;
    public $image_height = 300;
    //Cover Image
    public $cover_image;
    public $cover_width = 1693;
    public $cover_height = 376;


    protected $listeners = [
        'VendorsCreateChange'
    ];
    protected function rules(){
        $rules = [
            'first_name'=>'required',
            'last_name'=>'required',
            'image'=>'image|max:2048|nullable',
            'email'=>'required|email|unique:users',
            'dni'=>'required|unique:vendors',
        ];
        return $rules;
    }
    protected $messages = [
        'first_name.required'=>'First name is required',
        'last_name.required'=>'Last name is required',
        'image.max'=>'Your image exceeds 2MB of capacity',
        'email.email'=>'Please enter a valid Email',
        'email.unique'=>'Mail already exists',
        'email.required'=>'Email is required',
        'dni.required'=>'Dni is required',
        'dni.unique'=>'Dni is unique',
    ];
    public function hydrate(){
        $this->emit('VendorsCreateHydrate');
    }
    public function VendorsCreateChange($value, $key){
        $this->$key = $value;
    }
    public  function closeAndClean(){
        $this->reset([
            'first_name',
            'last_name',
            'image',
            'email',
            'phone',
            'dni'
        ]);
        $this->resetValidation([
            'first_name',
            'last_name',
            'image',
            'email',
            'phone',
            'dni'
        ]);
    }
    public function save(){
        $this->validate();
        $firstNameWords = explode(' ', $this->first_name);
        $lastNameWords = explode(' ', $this->last_name);
        $this->user_name =$firstNameWords[0] . ' ' . $lastNameWords[0];
        $cover_image = null;
        $image = null;
        if ($this->image){
            $image = Str::slug($this->user_name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image->getClientOriginalExtension();
            Image::make($this->image)->resize($this->image_width,$this->image_height)->save(public_path('uploads/users/'.$image,50));
        }
        if ($this->cover_image){
            $cover_image = Str::slug($this->user_name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->cover_image->getClientOriginalExtension();
            Image::make($this->cover_image)->resize($this->cover_width,$this->cover_height)->save(public_path('uploads/users/cover_image/'.$cover_image,50));
        }
        //Create User
        $user = new User();
        $user->profile_photo = $image;
        $user->cover_image = $cover_image;
        $user->name =$firstNameWords[0] . ' ' . $lastNameWords[0];
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->save();
        $user->assignRole('Vendor');
        //Create Vendor
        $vendor = new Vendor();
        $vendor->user_id = $user->id;
        $vendor->first_name = $this->first_name;
        $vendor->last_name = $this->last_name;
        $vendor->phone = $this->phone;
        $vendor->dni = $this->dni;
        $vendor->save();
        $this->emitTo('vendors.show','render');
        $this->emit('alert',__('Registered Vendor!'),'#create');
        $this->emit('VendorsShowRender');
        $this->closeAndClean();

    }
    public function render()
    {
        return view('livewire.vendors.create');
    }
}
