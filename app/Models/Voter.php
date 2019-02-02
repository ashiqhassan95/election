<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    protected $table = 'voters';

    protected $fillable = [
        'name', 'admission_number', 'roll_number', 'birth_date', 'gender',
        'uid', 'standard_id', 'institute_id', 'user_id'
    ];

    //protected $with = ['user', 'standard'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function standard()
    {
        return $this->belongsTo(Standard::class);
    }

    public function gender()
    {
        if ($this['gender'] == 0)  return 'Male';
        if ($this['gender'] == 1)  return 'Female';
        if ($this['gender'] == 2)  return 'Other';
    }
}
