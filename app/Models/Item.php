<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    const TYPE_LOST = 'lost';
    const TYPE_FOUND = 'found';
    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function return()
    {
        return $this->hasMany(ReturnModel::class);
    }

    public function chat()
    {
        return $this->hasMany(Chat::class);
    }
}
