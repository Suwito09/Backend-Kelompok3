<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnModel extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
