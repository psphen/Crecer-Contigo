<?php

namespace App\Http\Livewire\Cities;

use App\Models\City;
use App\Models\Currency;
use App\Models\Language;
use App\Models\Month;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Image;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    //Create
    public $name;
    public $state_id;
    public $description;
    public $introduction;
    public $thumbnail_image;
    public $banner_image;
    public $currency_id;
    public $language_id;
    public $best_time_buy;
    public $address;
    public $latitude;
    public $longitude;
    public $is_active = true;

    //Mount
    public $states;
    public $currencies;
    public $languages;
    public $months;

    //Image
    public $thumbnail_width = 180;
    public $thumbnail_height = 180;
    public $banner_width =2000;
    public $banner_height = 700;


    protected $listeners = [
        'CitiesCreateChange'
    ];
    protected function rules(){
        $rules = [
            'name'=>'required',
            'state_id'=>'required',
            'description'=>'nullable',
            'introduction'=>'nullable',
            'thumbnail_image'=>'image|max:2048|nullable',
            'banner_image'=>'image|max:2048|nullable',
            'currency_id'=>'nullable',
            'language_id'=>'nullable',
            'best_time_buy'=>'nullable',
            'address'=>'nullable',
            'latitude'=>'nullable',
            'longitude'=>'nullable',
            'is_active'=>'nullable'
        ];
        return $rules;
    }
    protected $messages = [
        'name.required'=>'Name is required',
        'state_id.required'=>'State is required',
        'thumbnail_image.max'=>'Your image exceeds 2MB of capacity',
        'banner_image.max'=>'Your image exceeds 2MB of capacity'
    ];
    public function hydrate(){
        $this->emit('CitiesCreateHydrate');
    }

    public function CitiesCreateChange($value, $key){
        $this->$key = $value;
    }
    public function closeAndClean(){
        $this->reset([
            'name',
            'state_id',
            'description',
            'introduction',
            'thumbnail_image',
            'banner_image',
            'currency_id',
            'language_id',
            'best_time_buy',
            'address',
            'latitude',
            'longitude',
            'is_active'
        ]);
        $this->resetValidation([
            'name',
            'state_id',
            'description',
            'introduction',
            'thumbnail_image',
            'banner_image',
            'currency_id',
            'language_id',
            'best_time_buy',
            'address',
            'latitude',
            'longitude',
            'is_active'
        ]);
    }
    public function mount(){
        $this->states = State::where('is_active',true)->get();
        $this->currencies = Currency::where('is_active',true)->get();
        $this->languages = Language::where('is_active',true)->get();
        $this->months = Month::all();
    }
    public function save(){
        $this->validate();
        $thumbnail=null;
        $banner = null;
        if ($this->thumbnail_image){
            $thumbnail = Str::slug($this->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->thumbnail_image->getClientOriginalExtension();
            Image::make($this->thumbnail_image)->resize($this->thumbnail_width,$this->thumbnail_height)->save(public_path('uploads/cities/thumbnails/'.$thumbnail,50));
        }
        if ($this->banner_image){
            $banner = Str::slug($this->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->banner_image->getClientOriginalExtension();
            Image::make($this->banner_image)->resize($this->banner_width,$this->banner_height)->save(public_path('uploads/cities/banners/'.$banner,50));
        }
        $city = new City();
        $city->name = $this->name;
        $city->state_id = $this->state_id;
        $city->description = $this->description;
        $city->introduction = $this->introduction;
        $city->thumbnail_image = $thumbnail;
        $city->banner_image = $banner;
        $city->currency_id  = $this->currency_id;
        $city->language_id = $this->language_id;
        $city->best_time_buy =  $this->best_time_buy;
        $city->address = $this->address;
        $city->latitude = $this->latitude;
        $city->longitude = $this->longitude;
        $city->is_active = $this->is_active;
        $city->save();
        $this->emitTo('cities.show','render');
        $this->emit('alert',__('Registered City!'),'#create');
        $this->emit('CitiesShowRender');
        $this->closeAndClean();
    }
    public function render()
    {
        return view('livewire.cities.create');
    }
}
