<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = Str::slug($post->name);
        });
    }
    public function place()
    {
        return $this->belongsTo(Place::class,'place_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->hasMany(CommentsPost::class);
    }
    
    public function likes()
    {
        return $this->hasMany(LikePost::class);
    }
}
