<?php

namespace App\Livewire\Cities;

use App\Models\City;
use App\Models\Currency;
use App\Models\Language;
use App\Models\Month;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Image;
class Show extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners =[
        'CitiesShowChange',
        'CitiesShowRender'=>'render'
    ];
    //Mount
    public $states;
    public $currencies;
    public $languages;
    public $months;
    public $is_active=true;
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
    public function updatingQuery(){
        $this->resetPage();
    }
    public function hydrate(){
        $this->emit('CitiesShowHydrate');
    }
    public function CitiesShowChange($value, $key){
        $this->$key = $value;
    }

    public function readyToLoad(){
        $this->readyToLoad= true;
    }
    public function mount(){
        $this->states = State::where('is_active',true)->get();
        $this->currencies = Currency::where('is_active',true)->get();
        $this->languages = Language::where('is_active',true)->get();
        $this->months = Month::all();
    }
    public function render()
    {
        if ($this->readyToLoad){
            $cities = $this->chargingData();
        }else{
            $cities = [];
        }
        return view('livewire.cities.show',compact('cities'));
    }
    public function chargingData()
    {
        $query = City::query();
        if ($this->query) {
            $query->where('name', 'like', '%' . $this->query . '%');
        }
        if ($this->is_active !== '') {
            $query->where('is_active', $this->is_active);
            $this->resetPage();
        }
        $query->orderBy($this->orderBy['field'], $this->orderBy['direction']);

        $totalCount = $query->count();

        $results = $query->paginate($this->cant);

        $results->total($totalCount);
        return $results;
    }
    //Edit
    public $city;
    public $thumbnail_image_edit;
    public $banner_image_edit;
    public $address_edit;
    public $latitude_edit;
    public $longitude_edit;
    //Image
    public $thumbnail_image;
    public $banner_image;
    public $thumbnail_width = 533;
    public $thumbnail_height = 400;
    public $banner_width =2000;
    public $banner_height = 700;

    protected function rules(){
        $rules = [
            'city.name'=>'required',
            'city.state_id'=>'required',
            'city.description'=>'nullable',
            'city.introduction'=>'nullable',
            'thumbnail_image'=>'image|max:2048|nullable',
            'banner_image'=>'image|max:2048|nullable',
            'city.currency_id'=>'nullable',
            'city.language_id'=>'nullable',
            'city.best_time_buy'=>'nullable',
            'city.is_active'=>'nullable'
        ];
        return $rules;
    }
    public function edit(City $city){
        $this->city = $city;
        $this->thumbnail_image_edit = $this->city->thumbnail_image;
        $this->banner_image_edit = $this->city->banner_image;
        $this->address_edit = $this->city->address;
        $this->latitude_edit = $this->city->latitude;
        $this->longitude_edit = $this->city->longitude;
    }
    public function update(){
            if ($this->thumbnail_image){
                File::delete(public_path('uploads/cities/thumbnails/'.$this->city->thumbnail_image));
                $thumbnail = Str::slug($this->city->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->thumbnail_image->getClientOriginalExtension();
                Image::make($this->thumbnail_image)->resize($this->thumbnail_width, $this->thumbnail_height)->save(public_path('uploads/cities/thumbnails/' . $thumbnail, 50));
            }else{
                $thumbnail = $this->city->thumbnail_image;
            }
            if ($this->banner_image){
                File::delete(public_path('uploads/cities/banners/'.$this->city->banner_image));
                $banner = Str::slug($this->city->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->banner_image->getClientOriginalExtension();
                Image::make($this->banner_image)->resize($this->banner_width, $this->banner_height)->save(public_path('uploads/cities/banners/' . $banner, 50));
            }else{
                $banner = $this->city->banner_image;
            }
            $this->city->thumbnail_image = $thumbnail;
            $this->city->banner_image   = $banner;
             if ($this->address_edit){
                 $this->city->address =$this->address_edit;
             }
             if ($this->latitude_edit){
                 $this->city->latitude = $this->latitude_edit;
             }
             if ($this->longitude_edit){
                 $this->city->longitude = $this->longitude_edit;
             }
             $this->city->save();
            $this->emitTo('cities.show','render');
            $this->emit('alert',__('City updated!'),'#edit');
            $this->emit('CitiesShowRender');
            $this->reset('thumbnail_image');
    }
    public function delete(City $city){
        $this->city = $city;
    }
    public function destroy(){
        File::delete(public_path('uploads/cities/thumbnails/'.$this->city->thumbnail_image));
        File::delete(public_path('uploads/cities/banners/'.$this->city->banner_image));
        $this->city->delete();
        $this->emitTo('cities.show','render');
        $this->emit('alert',__('City deleted!'),'#delete');
        $this->emit('CitiesShowRender');
    }
}
