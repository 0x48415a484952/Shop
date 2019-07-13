<?php

namespace App\Models;

use App\Models\ProductVariation;
use App\Models\Address;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Information;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'social_id', 'phone', 'password', 'phone_verification_code',
    ];

    protected $hidden = [
        'password', 'confirm_password', 'remember_token', 'phone_verification_code',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->password = bcrypt($user->password);
        });
    }

    public function getJWTIdentifier()
    {
        return $this->id;
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function cart() 
    {
        return $this->belongsToMany(ProductVariation::class, 'cart_user')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function information()
    {
        return $this->hasOne(Information::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}