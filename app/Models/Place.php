<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Place extends Model
{
    protected $fillable = ['user_id', 'name', 'type_id', 'city_id', 'phone', 'email'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($place) {
            $place->slug = Str::slug($place->name);
        });
    }
    public function categories(){
        return $this->belongsToMany(Category::class,'place_categories')->withPivot('category_id');
    }
    public function services(){
        return $this->belongsToMany(Service::class,'place_services')->withPivot('service_id');
    }
    public function type(){
        return $this->belongsTo(PlaceType::class,'type_id');
    }
    public  function city(){
        return $this->belongsTo(City::class,'city_id');
    }
    public function placeImages()
    {
        return $this->hasMany(PlaceImage::class);
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function schedules(){
        return $this->belongsToMany(WeekDay::class,'place_schedules')->withPivot('week_day_id');
    }
    public function placeSchedules()
    {
        return $this->hasMany(PlaceSchedule::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }

}
