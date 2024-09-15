<?php

namespace App\Http\Livewire\Testimonials;

use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;

class Create extends Component
{
    use WithFileUploads;

    //Image
    public $image_width = 240;
    public $image_height = 240;
    //Create
    public $image;
    public $name;
    public $content;

    protected $listeners = [
        'TestimonialsCreateChange'
    ];
    protected function rules(){
        $rules = [
            'image'=>'nullable|image|max:1024',
            'name'=>'required',
            'content'=>'nullable',
        ];
        return $rules;
    }
    protected $messages = [
        'name.required'=>'Name is required',
        'image.max'=>'Your image exceeds 2MB of capacity',
    ];
    public function hydrate(){
        $this->emit('TestimonialsCreateHydrate');
    }
    public function TestimonialsCreateChange($value, $key){
        $this->$key = $value;
    }
    public  function closeAndClean(){
        $this->reset([
            'image',
            'name',
            'content',
        ]);
        $this->resetValidation([
            'image',
            'name',
            'content',
        ]);
    }
    public function save(){
        $this->validate();
        $image = null;
        if ($this->image){
            $image = Str::slug($this->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image->getClientOriginalExtension();
            Image::make($this->image)->resize($this->image_width,$this->image_height)->save(public_path('uploads/testimonials/'.$image,50));
        }
        $testimonial = new Testimonial();
        $testimonial->image = $image;
        $testimonial->name = $this->name;
        $testimonial->content = $this->content;
        $testimonial->save();
        $this->emitTo('testimonials.show','render');
        $this->emit('alert',__('Registered Testimonial!'),'#create');
        $this->emit('TestimonialsShowRender');
        $this->closeAndClean();
    }
    public function render()
    {
        return view('livewire.testimonials.create');
    }
}
