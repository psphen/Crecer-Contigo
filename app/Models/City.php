<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class City extends Model
{
    protected $fillable = ['name'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($city) {
            $city->slug = Str::slug($city->name);
        });
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function places(){
        return $this->hasMany(Place::class);
    }
}
