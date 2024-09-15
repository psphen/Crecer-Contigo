<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceService extends Model
{
    public function services(){
        return $this->belongsTo(Service::class);
    }
}
