<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;  // <-- ini yang benar

class Users extends Authenticatable implements JWTSubject
{
    // Tentukan tabel yang digunakan
    protected $table = 'users';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'created_at',
    ];

    // Sembunyikan kolom password saat output JSON
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

    // Nonaktifkan timestamps otomatis Laravel jika ingin mengatur created_at manual
    public $timestamps = false;

    // Jika Anda ingin melakukan casting tipe data tertentu
    protected $casts = [
        'created_at' => 'datetime',
    ];
}
