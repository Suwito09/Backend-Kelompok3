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

    public function getJwtIdentifier()
    {
        return $this->getKey();
    }

    public function getJwtCustomClaims()
    {
        return [];
    }

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
