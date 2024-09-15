<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    }

//    public function parentCategory()
//    {
//        return $this->belongsTo(Category::class, 'category_id');
//    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
