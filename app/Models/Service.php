<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'name', 
        'image', 
        'description', 
        'price',
        'sections',
        'is_active'
    ];
}
