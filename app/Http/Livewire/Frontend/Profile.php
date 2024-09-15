<?php

namespace App\Http\Livewire\Frontend;

use App\Models\PlaceImage;
use App\Models\User;
use App\Models\Category;
use App\Models\Place;
use App\Models\Post;
use App\Models\Visitor;
use App\Models\Vendor;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;

class Profile extends Component
{
    public $user;
    public $profile_photo;
    public $banner_photo;
    public $customer;
    public $perPage = 4;
    use WithFileUploads;
    use WithPagination;
    //Mount
    public $categories;
    public $places;
    //Image
    public $image;
    public $image_banner;
    public $post_width = 300;
    public $post_height = 200;
    public $image_width = 200;
    public $image_height = 200;
    public $banner_width = 1800;
    public $banner_height = 900 ;
    //Create
    public $place_id;
    public $category_id;
    public $name;
    public $price;
    public $content;
    public $is_feature = false;
    public $best_selling = false;
    public $is_active = true;

    public $existingImages = [];
    public $folderName;
    public $images = [];

    protected $listeners = [
        'PostsCreateChange',
        'PostsShowChange',
        'PostsShowRender'=>'render'
    ];
    protected function rules(){
        $rules = [
            'category_id'=>'required',
            'image'=>'nullable|image|max:3000',
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
    public function hydrate(){
        $this->emit('PostsCreateHydrate');
    }
    public function PostsCreateChange($value, $key){
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
    public function mount($userSlug,$userId)
    {
        $this->user = User::where('slug',$userSlug)->where('id',$userId)->first();
        $this->places = Place::all();
        $this->categories = Category::all();
        // Buscar el cliente que se está editando
        $customer = Customer::where('user_id', $this->user->id)->first();
        $vendor = Vendor::where('user_id', $this->user->id)->first();

        if ($customer) {
            // Obtener el usuario (user) relacionado con el cliente
            $this->user = $customer->user;

            // Verificar si el usuario es válido
            if ($this->user) {
                // Asigna los valores de nombre y apellido del cliente
                $this->first_name = $customer->first_name;
                $this->last_name = $customer->last_name;
                $this->phone = $customer->phone;
                $this->profile_photo = $this->user->profile_photo;
                $this->banner_photo = $this->user->banner_photo;
                $this->email = $this->user->email;
            }
            // Establecer $this->customer
            $this->customer = $customer;
        }
        if ($vendor) {
            // Obtener el usuario (user) relacionado con el cliente
            $this->user = $vendor->user;
            // Verificar si el usuario es válido
            if ($this->user) {
                // Asigna los valores de nombre y apellido del cliente
                $this->first_name = $vendor->first_name;
                $this->last_name = $vendor->last_name;
                $this->phone = $vendor->phone;
                $this->profile_photo = $this->user->profile_photo;
                $this->banner_photo = $this->user->banner_photo;
                $this->email = $this->user->email;
            }
            // Establecer $this->customer
            $this->vendor = $vendor;
        }
        $this->existingImages = $this->user->place->placeImages;
        $this->folderName = 'place_'.$this->user->place->id;

    }
//    public function removeImage()
//    {
//        // Limpiar la imagen seleccionada
//        $this->image = null;
//    }
    public function removeImageBanner()
    {
        // Limpiar la imagen seleccionada
        $this->image_banner = null;
    }
    public function storeImage()
    {
        if ($this->image) {
            // Generar un nombre único para la imagen
            $imageName = md5($this->image . microtime()) . '.' . $this->image->getClientOriginalExtension();

            // Guardar la imagen en la carpeta public/uploads/users
            $this->image->storeAs('public/uploads/users', $imageName);

            // Actualizar la propiedad profile_photo con el nombre de la imagen
            $this->profile_photo = $imageName;
        }
    }
    public function editUser($editUserId)
    {
        // Buscar el cliente que se está editando
        $customer = Customer::where('user_id', $editUserId)->first();
        $vendor = Vendor::where('user_id', $editUserId)->first();

        if ($customer) {
            // Obtener el usuario (user) relacionado con el cliente
            $this->user = $customer->user;

            // Verificar si el usuario es válido
            if ($this->user) {
                // Asigna los valores de nombre y apellido del cliente
                $this->first_name = $customer->first_name;
                $this->last_name = $customer->last_name;
                $this->phone = $customer->phone;
                $this->profile_photo = $this->user->profile_photo;
                $this->banner_photo = $this->user->banner_photo;
                $this->email = $this->user->email;
            }

            // Establecer $this->customer
            $this->customer = $customer;
        }
        if ($vendor) {
            // Obtener el usuario (user) relacionado con el cliente
            $this->user = $vendor->user;

            // Verificar si el usuario es válido
            if ($this->user) {
                // Asigna los valores de nombre y apellido del cliente
                $this->first_name = $vendor->first_name;
                $this->last_name = $vendor->last_name;
                $this->phone = $vendor->phone;
                $this->profile_photo = $this->user->profile_photo;
                $this->banner_photo = $this->user->banner_photo;
                $this->email = $this->user->email;
            }

            // Establecer $this->customer
            $this->vendor = $vendor;
        }
    }
    public function update()
    {
        if ($this->customer) {
            // Guarda la imagen y obtén el nombre de la imagen guardada
            $imageName = $this->storeImage();

            // Actualiza el nombre del usuario en la tabla `users`
            if ($this->user) {
                if ($this->image){
                    File::delete(public_path('uploads/users/'.$this->user->profile_photo));
                    $image = Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image->getClientOriginalExtension();
                    Image::make($this->image)->resize($this->image_width, $this->image_height)->save(public_path('uploads/users/' . $image, 50));
                }else{
                    $image = $this->user->profile_photo;
                }
                if ($this->image_banner){
                    File::delete(public_path('uploads/users/'.$this->user->banner_photo));
                    $image_banner = Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image_banner->getClientOriginalExtension();
                    Image::make($this->image_banner)->resize($this->banner_width, $this->banner_height)->save(public_path('uploads/users/' . $image_banner, 100));
                }else{
                    $image_banner = $this->user->banner_photo;
                }
                $firstNameWords = explode(' ', $this->first_name);
                $lastNameWords = explode(' ', $this->last_name);
                $newUserName = $firstNameWords[0] . ' ' . $lastNameWords[0];
                $this->user->name = $newUserName;
                $this->user->email = $this->email;
                $this->user->profile_photo = $image;
                $this->user->banner_photo = $image_banner;
                $this->user->save();
            }

            // Actualiza los datos del cliente en la tabla `customers`
            $this->customer->first_name = $this->first_name;
            $this->customer->last_name = $this->last_name;
            $this->customer->phone = $this->phone;
            $this->customer->save();

            // Cierra el modal y limpia los campos
            $this->closeAndClean();
        }
        else {
            // Guarda la imagen y obtén el nombre de la imagen guardada

            // Actualiza el nombre del usuario en la tabla `users`
            if ($this->user) {
                if ($this->image){
                    File::delete(public_path('uploads/users/'.$this->user->profile_photo));
                    $image = Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image->getClientOriginalExtension();
                    Image::make($this->image)->resize($this->image_width, $this->image_height)->save(public_path('uploads/users/' . $image, 50));
                }else{
                    $image = $this->user->profile_photo;
                }
                if ($this->image_banner){
                    File::delete(public_path('uploads/users/'.$this->user->banner_photo));
                    $image_banner = Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image_banner->getClientOriginalExtension();
                    Image::make($this->image_banner)->resize($this->banner_width, $this->banner_height)->save(public_path('uploads/users/' . $image_banner, 100));
                }else{
                    $image_banner = $this->user->banner_photo;
                }
                $firstNameWords = explode(' ', $this->first_name);
                $lastNameWords = explode(' ', $this->last_name);
                $newUserName = $firstNameWords[0] . ' ' . $lastNameWords[0];
                $this->user->name = $newUserName;
                $this->user->email = $this->email;
                $this->user->profile_photo = $image;
                $this->user->banner_photo = $image_banner;
                $this->user->save();
            }

            // Actualiza los datos del cliente en la tabla `customers`
            $this->vendor->first_name = $this->first_name;
            $this->vendor->last_name = $this->last_name;
            $this->vendor->phone = $this->phone;
            $this->vendor->save();

            // Cierra el modal y limpia los campos
            $this->closeAndClean();
        }
    }

    public function updateProfile()
    {

        if ($this->customer) {
            // Guarda la imagen y obtén el nombre de la imagen guardada
            $imageName = $this->storeImage();

            // Actualiza el nombre del usuario en la tabla `users`
            if ($this->user) {
                if ($this->image){
                    File::delete(public_path('uploads/users/'.$this->user->profile_photo));
                    $image = Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image->getClientOriginalExtension();
                    Image::make($this->image)->resize($this->image_width, $this->image_height)->save(public_path('uploads/users/' . $image, 50));
                }else{
                    $image = $this->user->profile_photo;
                }
                if ($this->image_banner){
                    File::delete(public_path('uploads/users/'.$this->user->banner_photo));
                    $image_banner = Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image_banner->getClientOriginalExtension();
                    Image::make($this->image_banner)->resize($this->banner_width, $this->banner_height)->save(public_path('uploads/users/' . $image_banner, 100));
                }else{
                    $image_banner = $this->user->banner_photo;
                }
                $firstNameWords = explode(' ', $this->first_name);
                $lastNameWords = explode(' ', $this->last_name);
                $newUserName = $firstNameWords[0] . ' ' . $lastNameWords[0];
                $this->user->name = $newUserName;
                $this->user->email = $this->email;
                $this->user->profile_photo = $image;
                $this->user->banner_photo = $image_banner;
                $this->user->save();
            }

            // Actualiza los datos del cliente en la tabla `customers`
            $this->customer->first_name = $this->first_name;
            $this->customer->last_name = $this->last_name;
            $this->customer->phone = $this->phone;
            $this->customer->save();

            // Cierra el modal y limpia los campos
            $this->closeAndClean();
        }
        else {
            // Guarda la imagen y obtén el nombre de la imagen guardada

            // Actualiza el nombre del usuario en la tabla `users`
            if ($this->user) {
                if ($this->image){
                    File::delete(public_path('uploads/users/'.$this->user->profile_photo));
                    $image = Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image->getClientOriginalExtension();
                    Image::make($this->image)->resize($this->image_width, $this->image_height)->save(public_path('uploads/users/' . $image, 50));
                }else{
                    $image = $this->user->profile_photo;
                }
                if ($this->image_banner){
                    File::delete(public_path('uploads/users/'.$this->user->banner_photo));
                    $image_banner = Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image_banner->getClientOriginalExtension();
                    Image::make($this->image_banner)->resize($this->banner_width, $this->banner_height)->save(public_path('uploads/users/' . $image_banner, 100));
                }else{
                    $image_banner = $this->user->banner_photo;
                }
                $firstNameWords = explode(' ', $this->first_name);
                $lastNameWords = explode(' ', $this->last_name);
                $newUserName = $firstNameWords[0] . ' ' . $lastNameWords[0];
                $this->user->name = $newUserName;
                $this->user->email = $this->email;
                $this->user->profile_photo = $image;
                $this->user->banner_photo = $image_banner;
                $this->user->save();
            }

            // Actualiza los datos del cliente en la tabla `customers`
            $this->vendor->first_name = $this->first_name;
            $this->vendor->last_name = $this->last_name;
            $this->vendor->phone = $this->phone;
            $this->vendor->save();

            // Cierra el modal y limpia los campos
            $this->closeAndClean();
        }
        $this->emitTo('frontend.profile','render');
        $this->emit('alert',__('Profile updated!'),'#user-profile');
        $this->emit('PostsShowRender');
    }
    public function removeExistingImage($index)
    {
        if (isset($this->existingImages[$index])) {
            $removedImage = $this->existingImages[$index];
            // Eliminar la imagen de la base de datos
            $removedImage->delete();
            // Eliminar la imagen del sistema de archivos
            $imagePath = public_path('uploads/places/gallery/' . $this->folderName . '/' . $removedImage->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            // Actualizar la lista de imágenes en tiempo real
            $this->existingImages = $this->existingImages->except($index)->values();
        }
        $this->emit('refreshComponent');
    }
    public function removeImage($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
        $this->emit('refreshComponent');
        $this->reset('images');
    }
    public function updateGallery(){
        $imageNames = [];
        $folderName = 'place_' . $this->user->place->id;
        $folderPath = public_path('uploads/places/gallery/' . $folderName);
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0755, true);
        }
        foreach ($this->images as $image) {
            $uniqueId = uniqid();
            $imageName = Carbon::now()->locale('co')->format('Y-m-d-H-i-s') . '-' . $uniqueId . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/places/gallery/' . $folderName . '/' . $imageName;
            Image::make($image)->save(public_path($imagePath));
            $imageNames[] = $imageName;
        }
        foreach ($imageNames as $imageName) {
            PlaceImage::create([
                'place_id' => $this->user->place->id,
                'image_path' => $imageName,
            ]);
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
            Image::make($this->image)->resize($this->post_width,$this->post_height)->save(public_path('uploads/posts/'.$image,50));
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
        $this->emit('postSaved');
        $this->closeAndClean();
    }
    public function userProfile($userProfile_id)
    {
        $user = User::where('id', $userProfile_id)->first();

        // Registra la visita
        Visitor::create([
            'user_id' => $user->id, // ID del usuario visitado
            'visited_at' => now(), // Fecha y hora de la visita
        ]);

        return view('frontend.userprofile.index', compact('user'));
    }
    public function render()
    {
//        $user = Auth::user(); // Obtener el usuario autenticado
        $posts = Post::where('place_id', optional($this->user->place)->id)->paginate($this->perPage);

        $totalVisits = Visitor::where('user_id', $this->user->id)->count();
        $todayVisits = Visitor::where('user_id',$this->user->id)
            ->where('visited_at', '>=', now()->startOfDay()) // Desde el inicio del día actual
            ->where('visited_at', '<=', now()->endOfDay())   // Hasta el final del día actual
            ->count();

        $visitCounts = Visitor::select('user_id', \DB::raw('COUNT(*) as count'))
            ->where('visitor_id', $this->user->id)
            ->groupBy('user_id')
            ->get();

        return view('livewire.frontend.profile', [
            'posts' => $posts,
            'visitCounts' => $visitCounts,
            'totalVisits' => $totalVisits,
            'todayVisits' => $todayVisits,
        ]);
    }
}
