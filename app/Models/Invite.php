<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $table = 'invites';

    protected $fillable = [
        'email', 'token', 'role', 'user_id', 'created_at'
    ];

    public $timestamps = false;

    protected $with = [
        'user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
