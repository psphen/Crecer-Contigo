<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WeekDay extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($week_day) {
            $week_day->slug = Str::slug($week_day->name);
        });
    }
}
