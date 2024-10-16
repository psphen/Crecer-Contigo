<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psychologist extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'specialty',
        'work_days',
        'is_active'
    ];

    public function person()
    {
        return $this->belongsTo(PersonUser::class, 'person_id');
    }
}
