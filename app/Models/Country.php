<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Country extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($country) {
            $country->slug = Str::slug($country->name);
        });
    }
}
