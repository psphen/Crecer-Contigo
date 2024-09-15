<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Month extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($month) {
            $month->slug = Str::slug($month->name);
        });
    }
}
