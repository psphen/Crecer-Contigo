<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->slug = Str::slug($user->name);
        });
    }
    public function isAdmin()
    {
        return $this->hasAnyRole(['SuperAdmin', 'Admin', 'Editor']);
    }
    public function vendor(){
        return $this->hasOne(Vendor::class);
    }
    public function isVendor()
    {
        return $this->hasRole('Vendor');
    }
    public function customer(){
        return $this->hasOne(Customer::class);
    }
    public function isCustomer()
    {
        return $this->hasRole('Customer');
    }
    public function place(){
        return $this->hasOne(Place::class);
    }
    public function post()
    {
        return $this->hasOne(Post::class);
    }
    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }
}
