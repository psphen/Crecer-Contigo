<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class State extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($state) {
            $state->slug = Str::slug($state->name);
        });
    }
}
