<?php

namespace App\Http\Livewire\Places;

use App\Models\Category;
use App\Models\City;
use App\Models\Place;
use App\Models\PlaceImage;
use App\Models\PlaceType;
use App\Models\Service;
use App\Models\User;
use App\Models\WeekDay;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;
class Create extends Component
{
    use WithFileUploads;

    //Image
    public $image_width = 500;
    public $image_height = 334;

    //Banner
    public $banner_width = 1920;
    public $banner_height = 1080;
    //Create
    public $user_id;
    public $place_image;
    public $place_banner;
    public $name;
    public $description;
    public $price;
    public $type_id;
    public $city_id;
    public $address;
    public $latitude;
    public $longitude;
//    public $phone;
    public $instagram_url;
    public $facebook_url;
    public $email;
    public $site_web;
    public $video_type;
    public $video;
    //Video
    public $youtube;
    public $upload;
    //Gallery
    public $images = [];
    //Schedules
    public $placeSchedules;
    public $week_days;
    public $schedule;
    //Mount
    public $categories;
    public $types;
    public $cities;
    public $users;
    public $video_types;
    public $services;
    public $place_services;
    public $place_categories;

    protected $folderPath;

    protected $listeners = [
        'PlacesCreateChange',
        'typesUpdated'
    ];

    protected function rules(){
        $rules = [
            'user_id'=>'required',
            'place_image'=>'image|max:2048|nullable',
            'banner_image'=>'image|max:2048|nullable',
            'name'=>'required',
            'description'=>'nullable',
            'type_id'=>'nullable',
            'city_id'=>'required',
            'address'=>'nullable',
            'latitude'=>'nullable',
            'longitude'=>'nullable',
//            'phone'=>'nullable',
            'email'=>'nullable',
            'site_web'=>'nullable',
            'video'=>'file|nullable'
        ];
        return $rules;
    }
    protected $messages = [
        'user_id.required'=>'User is required',
        'name.required'=>'Name is required',
        'type_id.required'=>'Type is required',
        'city_id.required'=>'City is required',
    ];

    public function hydrate(){
        $this->emit('PlacesCreateHydrate');
    }
    public function PlacesCreateChange($value, $key){
        $this->$key = $value;
    }
    public function closeAndClean(){
        $this->reset([
            'user_id',
            'place_image',
            'place_banner',
            'name',
            'description',
            'type_id',
            'city_id',
            'address',
            'latitude',
            'longitude',
//            'phone',
            'facebook_url',
            'instagram_url',
            'email',
            'site_web',
            'images',
            'video_type',
            'video'
        ]);
        $this->resetValidation([
            'user_id',
            'place_image',
            'place_banner',
            'name',
            'description',
            'type_id',
            'city_id',
            'address',
            'latitude',
            'longitude',
//            'phone',
            'facebook_url',
            'instagram_url',
            'email',
            'site_web',
            'images',
            'video_type',
            'video'
        ]);
    }
    public function typesUpdated(){
        $this->types = PlaceType::all();
    }
    public function mount(){
        $this->categories = Category::all();
        $this->services = Service::all();
        $this->types = PlaceType::all();
        $this->cities = City::where('is_active',true)->get();
        $this->users = User::role('Vendor')->get();
        $this->placeSchedules = [
            ['week_day_id'=>'','start_hour'=>'','end_hour'=>'']
        ];
        $this->week_days = WeekDay::all();
        $this->video_types = [
            [
                'value'=>1,
                'name'=>'Youtube'
            ],
            [
                'value'=>2,
                'name'=>'Upload'
            ]
        ];
    }
    public function addSchedules(){
        $this->placeSchedules[] =['week_day_id'=>'','start_hour'=>'','end_hour'=>''];
    }
    public function removeSchedules($index){
        unset($this->placeSchedules[$index]);
        $this->placeSchedules = array_values($this->placeSchedules);
    }
    public function removeImage($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
    }
    public  function save(){
        $this->validate();
        $image = null;
        $banner = null;
        $folderPhotoName = 'places/photo/';
        $folderBannerName = 'places/banner/';
        if (!is_dir($folderPhotoName)) {
            mkdir($folderPhotoName, 0755, true);
        }
        if (!is_dir($folderBannerName)) {
            mkdir($folderBannerName, 0755, true);
        }
        if ($this->place_image){
            $image = Str::slug($this->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->place_image->getClientOriginalExtension();
            Image::make($this->place_image)->resize($this->image_width,$this->image_height)->save(public_path('uploads/'.$folderPhotoName.$image,50));
        }
        if ($this->place_banner){
            $banner = Str::slug($this->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->place_banner->getClientOriginalExtension();
            Image::make($this->place_banner)->resize($this->banner_width,$this->banner_height)->save(public_path('uploads/'.$folderBannerName.$banner,50));
        }
        $place = new Place();
        $place->user_id = $this->user_id;
        $place->image = $image;
        $place->banner = $banner;
        $place->name = $this->name;
        $place->description = $this->description;
        $place->type_id = $this->type_id;
        $place->city_id = $this->city_id;
        $place->address = $this->address;
        $place->latitude = $this->latitude;
        $place->longitude = $this->longitude;
//        $place->phone = $this->phone;
        $place->instagram_url =$this->instagram_url;
        $place->facebook_url = $this->facebook_url;
        $place->email = $this->email;
        $place->site_web = $this->site_web;
        $place->video_type  = $this->video_type;
        if ($this->video_type==1){
            $place->video = $this->youtube;
        }else{
            $upload = null;
            if ($this->upload){
                $filename = Str::slug($this->name) .'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s') .'.'.$this->upload->getClientOriginalExtension();
                $this->upload->storeAs('uploads/places/video', $filename, 'agro');
                $upload = $filename;
            }
            $place->video = $upload;
        }
        $place->save();
        if ($this->place_services){
            $services = array_filter((array)$this->place_services);
            $place->services()->sync($services);
        }
        if ($this->place_categories){
            $categories = array_filter((array)$this->place_categories);
            $place->categories()->sync($categories);
        }
        foreach ($this->placeSchedules as $placeSchedule) {
            if (!empty($placeSchedule['week_day_id'])) {
                $schedules[] = $placeSchedule;
            }
        }
        if (!empty($schedules)) {
            $place->schedules()->sync($schedules);
        }
        $folderName = 'place_' . $place->id;
        $folderPath = public_path('uploads/places/gallery/' . $folderName);
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0755, true);
        }
        // Guardar las imágenes en la carpeta correspondiente al lugar y obtener los nombres de archivo
        $imageNames = [];
        foreach ($this->images as $image) {
            $uniqueId = uniqid();
            $imageName = Carbon::now()->locale('co')->format('Y-m-d-H-i-s') . '-' . $uniqueId . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/places/gallery/' . $folderName . '/' . $imageName;
            Image::make($image)->save(public_path($imagePath));
            $imageNames[] = $imageName;
        }
        // Guardar los nombres de las imágenes en la base de datos
        foreach ($imageNames as $imageName) {
            PlaceImage::create([
                'place_id' => $place->id,
                'image_path' => $imageName,
            ]);
        }
        $this->emitTo('places.show','render');
        $this->emit('alert',__('Registered Place!'),'#create');
        $this->emit('PlacesShowRender');
        $this->closeAndClean();
    }
    public function render()
    {
        return view('livewire.places.create');
    }
}
