<?php

namespace App\Http\Livewire\Services;

use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
Use Image;

class Show extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $listeners = [
        'ServicesShowChange',
        'ServicesShowRender'=>'render'
    ];
    //Edit
    public $service;
    public $icon;
    public $icon_edit;
    //Image
    public $icon_width = 100;
    public $icon_height = 100;
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
    public function updatingQuery(){
        $this->resetPage();
    }
    public  function hydrate(){
        $this->emit('ServicesShowHydrate');
    }
    public function ServicesShowChange($value, $key){
        $this->$key = $value;
    }
    public function readyToLoad(){
        $this->readyToLoad= true;
    }
    public  function chargingData(){
        $query= Service::query();
        if ($this->query){
            $query->where('name', 'like', '%' . $this->query . '%');
        }
        $query->orderBy($this->orderBy['field'], $this->orderBy['direction']);
        return $query->paginate($this->cant);
    }
    //Edit
    protected function rules(){
        $rules = [
            'service.name'=>'required',
            'icon'=>'image|max:2048|nullable',
        ];
        return $rules;
    }
    public  function edit(Service $service){
        $this->service = $service;
        $this->icon_edit = $this->service->icon;
    }
    public function update(){
        if ($this->icon){
            File::delete(public_path('uploads/categories/icons/'.$this->service->icon));
            $icon = Str::slug($this->service->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->icon->getClientOriginalExtension();
            Image::make($this->icon)->resize($this->icon_width, $this->icon_height)->save(public_path('uploads/services/icons/' . $icon, 50));
        }else{
            $icon = $this->service->icon;
        }
        $this->service->icon = $icon;
        $this->service->save();
        $this->emitTo('services.show','render');
        $this->emit('alert',__('Service updated!'),'#edit');
        $this->emit('ServicesShowRender');
    }
    public  function delete(Service $service){

        $this->service = $service;
    }
    public function destroy(){
        File::delete(public_path('uploads/categories/icons/'.$this->service->icon));
        $this->service->delete();
        $this->emitTo('services.show','render');
        $this->emit('alert',__('Service deleted!'),'#delete');
        $this->emit('ServicesShowRender');
    }
    public function render()
    {
        if ($this->readyToLoad){
            $services = $this->chargingData();
        }else{
            $services = [];
        }
        return view('livewire.services.show',compact('services'));
    }
}
