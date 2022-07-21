<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $guarded = [
        'id', 'users_id', 'created_at', 'updated_at'
    ];

    public function sending_user()
    {
        return $this->belongsTo(User::class, 'sending_user_id');
    }

    public function new_user()
    {
        return $this->belongsTo(User::class, 'new_user_id');
    }
}
