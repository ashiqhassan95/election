<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    protected $table = 'standards';

    protected $fillable = [
        'name', 'institute_id', 'user_id'
    ];

    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voters()
    {
        return $this->hasMany(Voter::class);
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

}
