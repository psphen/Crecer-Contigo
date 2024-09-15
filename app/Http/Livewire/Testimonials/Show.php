<?php

namespace App\Http\Livewire\Testimonials;

use App\Models\Testimonial;
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

    protected $listeners =[
        'TestimonialsShowChange',
        'TestimonialsShowRender'=>'render'
    ];
    //Edit
    public $testimonial;
    public $testimonial_image;
    //Image
    public $image_width = 240;
    public $image_height = 240;
    public $image;
    //Query
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
        $this->emit('TestimonialsShowHydrate');
    }
    public function TestimonialsShowChange($value, $key){
        $this->$key = $value;
    }

    public function readyToLoad(){
        $this->readyToLoad= true;
    }
    public function chargingData(){
        $query = Testimonial::query();
        if ($this->query){
            $query->where('name', 'like', '%' . $this->query .'%');
        }
        $query->orderBy($this->orderBy['field'], $this->orderBy['direction']);
        return $query->paginate($this->cant);
    }
    //Edit
    protected function rules(){
        $rules = [
            'image'=>'nullable|image|max:1024',
            'testimonial.name'=>'',
            'testimonial.content'=>'',
        ];
        return $rules;
    }
    public function edit(Testimonial $testimonial){
        $this->testimonial = $testimonial;
        $this->testimonial_image = $this->testimonial->image;
    }
    public function update(){
        if ($this->image){
            File::delete(public_path('uploads/testimonials/'.$this->testimonial->image));
            $image = Str::slug($this->testimonial->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image->getClientOriginalExtension();
            Image::make($this->image)->resize($this->image_width, $this->image_height)->save(public_path('uploads/testimonials/' . $image, 50));
        }else{
            $image = $this->testimonial->image;
        }
        $this->testimonial->image = $image;
        $this->testimonial->save();
        $this->emitTo('testimonials.show','render');
        $this->emit('alert',__('Testimonial updated!'),'#edit');
        $this->emit('TestimonialsShowRender');
    }
    public function delete(Testimonial $testimonial){
        $this->testimonial = $testimonial;
    }
    public function destroy(){
        File::delete(public_path('uploads/testimonials/'.$this->testimonial->image));
        $this->testimonial->delete();
        $this->emitTo('testimonials.show','render');
        $this->emit('alert',__('Testimonial deleted!'),'#delete');
        $this->emit('TestimonialsShowRender');
    }
    public function render()
    {
        if ($this->readyToLoad){
            $testimonials = $this->chargingData();
        }else{
            $testimonials = [];
        }
        return view('livewire.testimonials.show',compact('testimonials'));
    }
}
