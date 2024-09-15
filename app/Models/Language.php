<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Language extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($language) {
            $language->slug = Str::slug($language->code);
        });
    }
}
