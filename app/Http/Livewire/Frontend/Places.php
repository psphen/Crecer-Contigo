<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Place;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Google_Client;
use Google_Service_YouTube;


class Places extends Component
{
    public $placeSlug;
    public $place;
    public $folderName;
    public $videoId;
    public $embedUrl;

    //Reviews
    public $reviews;
    //Create
    public $score = 0;
    public $comment;
    public $latitude=4.570868;
    public $longitude=-74.297333;

    protected $listeners = [
        'PlacesShowChange',
        'PlacesShowRender'=>'render',
        'commentSaved'
    ];
    public function commentSaved(){
        $this->reviews = Review::all();
    }
    public function mount($placeSlug){
        $this->placeSlug = $placeSlug;
        $this->place = Place::where('slug',$this->placeSlug)->first();
        $this->folderName = 'place_'.$this->place->id;
        $videoId = $this->extractVideoId($this->place->video);
        $this->embedUrl = 'https://www.youtube.com/embed/' . $videoId;
        $this->reviews = Review::where('place_id',$this->place->id)->get();
        if($this->place->latitude && $this->place->longitude){
            $this->latitude = $this->place->latitude;
            $this->longitude = $this->place->longitude;

        }elseif ($this->place->city->latitude && $this->place->city->longitude) {
            $this->latitude = $this->place->city->latitude;
            $this->longitude = $this->place->city->longitude;
        }else{
            $this->latitude = 4.570868;
            $this->longitude = -74.297333;
        }
    }
    public function renderStars($score)
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $score) {
                $stars .= '★';
            } else {
                $stars .= '☆';
            }
        }
        return $stars;
    }
    public  function hydrate(){
        $this->emit('PlacesShowHydrate');
    }
    public function PlacesShowChange($value, $key){
        $this->$key = $value;
    }
     protected function rules(){
        $rules = [
            'score' => 'required|integer|min:1|max:5',
            'comment' => 'required|max:255',
        ];
        return $rules;
     }
     public function closeAndClean(){
        $this->reset([
            'score',
            'comment'
        ]);
        $this->resetValidation([
            'score',
            'comment'
        ]);
     }
    public function setReview($score)
    {
        $this->score = $score;
    }

    public function renderStar($star)
    {
        return $this->score >= $star ? '★' : '☆';
    }
    public function saveReview(){
        $this->validate();
        $review = new Review();
        $review->user_id = Auth::user()->id;
        $review->place_id = $this->place->id;
        $review->score = $this->score;
        $review->comment = $this->comment;
        $review->status = 0;
        $review->save();
        $this->emitTo('frontend.places','render');
        $this->emit('PlacesShowRender');
        $this->emitSelf('commentSaved');
        $this->closeAndClean();
    }
    public function render()
    {

        return view('livewire.frontend.places');
    }
    private function extractVideoId($videoUrl)
    {
        $videoId = '';

        parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query);

        if (isset($query['v'])) {
            $videoId = $query['v'];
        }

        return $videoId;
    }
}
