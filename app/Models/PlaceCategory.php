<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceCategory extends Model
{
  public function categories(){
      return $this->belongsTo(Category::class);
  }
}
