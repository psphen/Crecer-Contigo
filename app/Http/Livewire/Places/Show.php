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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class Show extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $listeners = [
        'PlacesShowChange',
        'PlacesShowRender'=>'render',
        'refreshComponent'
    ];
    //Init
    public $readyToLoad = false;
    public $maintenance = false;
    public $query='';
    public $cant ='10';
    public $file;
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
    //Place types
    public $place_types;
    public $addTypes;
    //Edit
    public $place;
    public $address_edit;
    public $latitude_edit;
    public $longitude_edit;
    public $existingImages = [];
    public $folderName;
    public $images = [];
    public $video_type_edit;
    public $video_edit;
    public $place_categories_edit;
    public $place_services_edit;
    //Image
    public $image_width = 500;
    public $image_height = 334;
    public $place_image_update;
    public $place_image_edit;
//    Banner
    public $banner_width = 1920;
    public $banner_height = 550;
    public $place_banner_update;
    public $place_banner_edit;
    //Schedules
    public $placeSchedules;
    public $week_days;
    //Mount
    public $categories;
    public $services;
    public $types;
    public $cities;
    public $users;
    public $video_types;

    //Video
    public $youtube_edit;
    public $upload_edit;
    //Search

    public function updatingQuery(){
        $this->resetPage();
    }
    public  function hydrate(){
        $this->emit('PlacesShowHydrate');
    }
    public function PlacesShowChange($value, $key){
        $this->$key = $value;
    }
    public function readyToLoad(){
        $this->readyToLoad= true;
    }
    public function mount(){
        $this->place_types = PlaceType::all();
        $this->addTypes = $this->place_types->toArray();
        $this->categories = Category::all();
        $this->services = Service::all();
        $this->types = PlaceType::all();
        $this->cities = City::where('is_active',true)->get();
        $this->users = User::role('Vendor')->get();
        $this->week_days = WeekDay::all();
        $this->placeSchedules = [
            ['week_day_id'=>'','start_hour'=>'','end_hour'=>'']
        ];
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
    public function addTypes()
    {
        $newType = ['id' => null, 'name' => ''];
        $this->addTypes[] = $newType;
    }

    public function updateTypes()
    {
        $existingTypes = PlaceType::pluck('name', 'id')->toArray();
        foreach ($this->addTypes as $typeData) {
            if (!empty($typeData['name'])) {
                if (isset($existingTypes[$typeData['id']])) {
                    $type = PlaceType::find($typeData['id']);
                    $type->name = $typeData['name'];
                    $type->save();
                } elseif (in_array($typeData['name'], $existingTypes)) {
                    continue;
                } else {
                    $type = new PlaceType();
                    $type->name = $typeData['name'];
                    $type->save();
                }
            }
        }
        $this->addTypes = [];
        $this->mount();
        $this->emitTo('places.types', 'render');
        $this->emit('alert', __('Updated place types!'), '#types');
        $this->emit('PlacesShowRender');
        $this->emit('PlacesCreateRender');
        $this->emit('typesUpdated');
    }

    public function removeTypes($index)
    {
        $type = PlaceType::find($this->addTypes[$index]['id']);
        if ($type) {
            $type->delete();
        }
        unset($this->addTypes[$index]);
        $this->addTypes = array_values($this->addTypes);
    }

    public function chargingData(){
        $query = Place::query();
        if ($this->query){
            $query->where('name', 'like', '%' . $this->query .'%');
        }
        $query->orderBy($this->orderBy['field'], $this->orderBy['direction']);
        return $query->paginate($this->cant);
    }
    //Edit
    protected function rules(){
        $rules = [
            'place.name'=>'required',
            'place.description'=>'nullable',
            'place.type_id'=>'required',
            'place.city_id'=>'required',
            'place.phone'=>'nullable',
            'place.email'=>'nullable',
            'place.site_web'=>'nullable',
            'place.user_id'=>'',
            'place.facebook_url'=>'',
            'place.instagram_url'=>''
        ];
        return $rules;
    }
    public function closeAndClean(){
        $this->reset([
            'images',
            'upload_edit'
        ]);
    }
    public function edit(Place $place){
        $this->place = $place;
        $this->place_image_update = $this->place->image;
        $this->place_banner_update = $this->place->banner;
        $this->address_edit = $this->place->address;
        $this->latitude_edit = $this->place->latitude;
        $this->longitude_edit = $this->place->longitude;
        $this->existingImages = $this->place->placeImages;
        $this->folderName = 'place_'.$this->place->id;
        // Obtener los horarios existentes y asignarlos al array $placeSchedules
        $this->placeSchedules = $this->place->placeSchedules()->get()->toArray();
        $this->video_type_edit = $this->place->video_type;
        $this->video_edit = $this->place->video;
        $this->upload_edit = $this->place->video;
        $this->youtube_edit = $this->place->video;
        $this->place_categories_edit = $this->place->categories()->pluck('category_id')->toArray();
        $this->place_services_edit = $this->place->services()->pluck('service_id')->toArray();
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
    public function refreshComponent(){
        $this->reset('images');
    }

    public function update(){
        $folderPhotoName = 'places/photo/';
        $folderPhotoPath = public_path('uploads/'.$folderPhotoName);
        $folderBannerName = 'places/banner/';
        $folderBannerPath = public_path('uploads/'.$folderBannerName);

        if (!is_dir($folderPhotoPath)) {
            mkdir($folderPhotoPath, 0755, true);
        }
        if (!is_dir($folderBannerPath)) {
            mkdir($folderBannerPath, 0755, true);
        }
        if ($this->place_image_edit){
            File::delete(public_path('uploads/'.$folderPhotoName.$this->place->image));
            $image = Str::slug($this->place->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->place_image_edit->getClientOriginalExtension();
            Image::make($this->place_image_edit)->resize($this->image_width, $this->image_height)->save(public_path('uploads/'.$folderPhotoName . $image, 50));
        }else{
            $image = $this->place->image;
        }
        if ($this->place_banner_edit){
            File::delete(public_path('uploads/'.$folderBannerName.$this->place->banner));
            $banner = Str::slug($this->place->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->place_banner_edit->getClientOriginalExtension();
            Image::make($this->place_banner_edit)->resize($this->banner_width, $this->banner_height)->save(public_path('uploads/'.$folderBannerName . $banner, 50));
        }else{
            $banner = $this->place->banner;
        }
        $this->place->image= $image;
        $this->place->banner = $banner;
        if ($this->address_edit){
            $this->place->address = $this->address_edit;
        }
        if ($this->latitude_edit){
            $this->place->latitude = $this->latitude_edit;
        }
        if ($this->longitude_edit){
            $this->place->longitude = $this->longitude_edit;
        }
        if ($this->video_type_edit){
            $this->place->video_type = $this->video_type_edit;
        }
        if ($this->video_type_edit == 1) {
            $this->place->video = $this->youtube_edit;
        }
        else {
            File::delete(public_path('uploads/places/video/' . $this->place->video));
            $upload = null;
            if ($this->upload_edit){
                $filename = Str::slug($this->place->name) .'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s') .'.'.$this->upload_edit->getClientOriginalExtension();
                $this->upload_edit->storeAs('uploads/places/video', $filename, 'agro');
                $upload = $filename;
            }
            $this->place->video = $upload;
        }
        $this->place->save();
        if ($this->place_services_edit){
            $services = array_filter((array)$this->place_services_edit);
            $this->place->services()->sync($services);
        }
        if ($this->place_categories_edit){
            $categories = array_filter((array)$this->place_categories_edit);
            $this->place->categories()->sync($categories);
        }
        $this->place->placeSchedules()->delete();
        foreach ($this->placeSchedules as $placeSchedule) {
            if (!empty($placeSchedule['week_day_id'])) {
                $schedules[] = $placeSchedule;
            }
        }
        if (!empty($schedules)) {
            $this->place->schedules()->sync($schedules);
        }
        $imageNames = [];
        $folderName = 'place_' . $this->place->id;
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
                'place_id' => $this->place->id,
                'image_path' => $imageName,
            ]);
        }
        $this->emitTo('places.show','render');
        $this->emit('alert',__('Updated Place!'),'#edit');
        $this->emit('PlacesShowRender');
        $this->emit('refreshComponent');
        $this->closeAndClean();
    }
    public function delete(Place $place){
        $this->place = $place;
    }
    public function destroy(){
        File::delete(public_path('uploads/places/photo/'.$this->place->image));
        // Obtener todas las imágenes asociadas al lugar
        $images = $this->place->placeImages;

        // Eliminar las imágenes del sistema de archivos
        foreach ($images as $image) {
            $imagePath = public_path('uploads/places/gallery/' . $this->folderName . '/' . $image->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Eliminar las imágenes de la base de datos
        $this->place->placeImages()->delete();

        // Eliminar el lugar
        $this->place->delete();

        $this->emitTo('places.show', 'render');
        $this->emit('alert', __('Deleted Place!'), '#delete');
        $this->emit('PlacesShowRender');
    }
    public function render()
    {
        if ($this->readyToLoad){
            $places = $this->chargingData();
        }else{
            $places = [];
        }
        return view('livewire.places.show',compact('places'));
    }
}
