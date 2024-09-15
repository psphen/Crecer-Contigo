<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = ['user_id', 'visitor_id', 'visited_at'];
    
    public function visitedUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function scopeCountVisits($query)
    {
        return $query->select('user_id', \DB::raw('COUNT(*) as count'))
            ->groupBy('user_id');
    }
}
