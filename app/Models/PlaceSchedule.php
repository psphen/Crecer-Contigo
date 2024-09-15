<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceSchedule extends Model
{
    public  function weekDay(){
        return $this->belongsTo(WeekDay::class,'week_day_id');
    }
}
