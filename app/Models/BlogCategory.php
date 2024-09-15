<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blogCategory) {
            $blogCategory->slug = Str::slug($blogCategory->name);
        });
    }
}
