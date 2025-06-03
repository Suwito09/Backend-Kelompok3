<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'created_at',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public $timestamps = false;

    public function getJwtIdentifier()
    {
        return $this->getKey();
    }

    public function getJwtCustomClaims()
    {
        return [];
    }

    public function item()
    {
        return $this->hasMany(Item::class);
    }

    public function return()
    {
        return $this->hasMany(ReturnModel::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Chat::class, 'receiver_id');
    }
}
