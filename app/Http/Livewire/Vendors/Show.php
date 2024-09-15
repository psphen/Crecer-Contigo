<?php

namespace App\Http\Livewire\Vendors;

use App\Models\Vendor;
use App\Models\User;
use App\Models\City;
use App\Models\Place;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\VendorImport;
use Illuminate\Support\Facades\Hash;
use Image;

class Show extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $listeners = [
        'VendorsShowChange',
        'VendorsShowRender'=>'render'
    ];
    //Init
    public $readyToLoad = false;
    public $maintenance = false;
    public $query='';
    public $cant ='10';
    public $file;
    public $cityId;
    //Edit
    public $user;
    public $vendor;
    public $image_edit;
    public $cover_image_edit;
    public $password;
    public $email;
    public $togglePassword = false;
    public $user_name;
    public $dni;
    //Image
    public $image;
    public $image_width = 300;
    public $image_height = 300;
    //Cover Image
    public $cover_image;
    public $cover_width = 1693;
    public $cover_height = 376;
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
        'first_name' => 'Name',
    ];
    public function updatingQuery(){
        $this->resetPage();
    }
    public  function hydrate(){
        $this->emit('VendorsShowHydrate');
    }
    public function VendorsShowChange($value, $key){
        $this->$key = $value;
    }
    public function readyToLoad(){
        $this->readyToLoad= true;
    }
    public function chargingData(){
        $query = Vendor::query();
        if ($this->query != ''){
            $query->where('first_name', 'like', '%' . $this->query . '%');
            $query->orWhere('last_name', 'like', '%' . $this->query . '%');
        }
        $query->orderBy($this->orderBy['field'], $this->orderBy['direction']);
        return $query->paginate($this->cant);
    }
    public function render()
    {
        if ($this->readyToLoad){
            $vendors = $this->chargingData();
        }else{
            $vendors = [];
        }
        return view('livewire.vendors.show',compact('vendors'));
    }
    //Edit
    protected function rules(){
        $rules = [
            'vendor.first_name'=>'required',
            'vendor.last_name'=>'required',
            'image'=>'image|max:2048|nullable',
            'user.email'=>'required|email|unique:users',
            'vendor.phone'=>'required',
            'vendor.dni'=>'required'
        ];
        return $rules;
    }
    public  function closeAndClean(){
        $this->reset([
            'togglePassword',
        ]);

    }
    public function edit(Vendor $vendor){
        $this->vendor = $vendor;
        $this->user = $this->vendor->user;
        $this->image_edit = $this->user->profile_photo;
        $this->cover_image_edit = $this->user->cover_image;
        $this->email = $this->user->email;
    }
    public function update()
    {
        $firstNameWords = explode(' ', $this->vendor->first_name);
        $lastNameWords = explode(' ', $this->vendor->last_name);
        $newUserName = $firstNameWords[0] . ' ' . $lastNameWords[0];
        $this->user->name = $newUserName;
        if ($this->image){
            File::delete(public_path('uploads/users/'.$this->user->profile_photo));
            $image = Str::slug($this->user_name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image->getClientOriginalExtension();
            Image::make($this->image)->resize($this->image_width, $this->image_height)->save(public_path('uploads/users/' . $image, 50));
        }else{
            $image = $this->user->profile_photo;
        }
        if ($this->cover_image){
            File::delete(public_path('uploads/users/cover_image/'.$this->user->cover_image));
            $cover = Str::slug($this->user_name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->cover_image->getClientOriginalExtension();
            Image::make($this->cover_image)->resize($this->cover_width, $this->cover_height)->save(public_path('uploads/users/cover_image/' . $cover, 50));
        }else{
            $cover = $this->user->profile_photo;
        }

        $this->user->email = $this->email;
        if ($this->togglePassword){
            $this->user->password = bcrypt($this->password);
        }
        $this->user->profile_photo = $image;
        $this->user->cover_image = $cover;
        $this->vendor->save();
        $this->user->save();
        $this->emitTo('vendors.show','render');
        $this->emit('alert',__('Vendor updated!'),'#edit');
        $this->emit('VendorsShowRender');
    }
    public function delete(Vendor $vendor)
    {
        $this->vendor = $vendor;
        $this->user = $this->vendor->user;
    }
    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xls,xlsx,csv',
        ]);
    
        $data = Excel::toArray(new VendorImport, $this->file);
    
        foreach ($data[0] as $row) {
            $CityName = $row[5];
            $city = City::where('name', 'LIKE', "%$CityName%")->first();
            $cityId = null;
    
            // Crea un lugar relacionado con el vendedor y otros detalles
            if ($city) {
                $cityId = $city->id;
            }
    
            $user = null;
            // Busca un usuario existente por correo electrónico
            $existingUser = User::where('email', $row[3])->first();
    
            if ($existingUser) {
                // Actualiza los datos del usuario existente
                $existingUser->update([
                    'name' => $row[8],
                    'slug' => $row[8],
                    'email' => $row[3],
                    'password' => Hash::make($row[9]),
                ]);
                $user = $existingUser;
            } else {
                // Crea un usuario
                $user = User::create([
                    'name' => $row[8],
                    'slug' => $row[8],
                    'email' => $row[3],
                    'password' => Hash::make($row[9]),
                ]);
            }
    
            // Busca un vendedor existente por DNI
            $existingVendor = Vendor::where('dni', $row[0])->first();
    
            if ($existingVendor) {
                // Si existe un vendedor asociado al usuario, actualiza los datos del vendedor
                $existingVendor->update([
                    'user_id' => $user->id,
                    'dni' => $row[0],
                    'first_name' => $row[1],
                    'last_name' => $row[2],
                    'phone' => $row[4],
                ]);
            } else {
                // Si no existe un vendedor asociado al DNI, crea uno nuevo
                Vendor::create([
                    'user_id' => $user->id,
                    'dni' => $row[0],
                    'first_name' => $row[1],
                    'last_name' => $row[2],
                    'phone' => $row[4],
                ]);
            }
    
            // Busca un lugar existente para el usuario
            // Crea un lugar asociado al usuario
            Place::create([
                'user_id' => $user->id,
                'name' => $row[7],
                'type_id' => 1, // Establece el ID del tipo de lugar según tus requisitos
                'city_id' => $cityId,
                'phone' => $row[4],
                'email' => $row[3],
                // Otros campos de lugar
            ]);
    
            // Asigna el rol (siempre se asigna un rol a los usuarios)
            $role = Role::find(4);
            if ($role) {
                $user->assignRole($role);
            }
        }
    }
    public function destroy()
    {
        $this->vendor->delete();
        File::delete(public_path('uploads/users/profile_photo/'.$this->user->profile_photo));
        File::delete(public_path('uploads/users/cover_image/'.$this->user->cover_image));
        $this->user->delete();
        $this->emitTo('vendors.show','render');
        $this->emit('alert',__('Vendor deleted!'),'#delete');
        $this->emit('VendorsShowRender');
    }
}
