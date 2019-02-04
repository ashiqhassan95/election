<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $table = 'institutes';

    protected $fillable = [
        'name', 'description', 'country', 'admin_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo('countries', 'code', 'country', 'countries');
    }
}
