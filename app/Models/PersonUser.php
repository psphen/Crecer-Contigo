<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonUser extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'first_name',
        'second_name',
        'last_name',
        'second_last_name',
        'phone',
        'dob',
        'dni',
        'person_id',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->second_name}  {$this->last_name} {$this->second_last_name}";
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
