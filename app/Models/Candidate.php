<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = 'candidates';

    protected $fillable = [
        'voter_id', 'image', 'is_active', 'standard_id',
        'position_id', 'election_id', 'institute_id', 'user_id'
    ];

    //protected $with = ['user', 'standard', 'position', 'voter'];

    protected $dates = [
        'birth_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function standard()
    {
        return $this->belongsTo(Standard::class, 'standard_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    public function voter()
    {
        return $this->belongsTo(Voter::class);
    }

    public function gender()
    {
        if ($this['gender'] == 0)  return 'Male';
        if ($this['gender'] == 1)  return 'Female';
        if ($this['gender'] == 2)  return 'Other';
    }

    public function getBirthDateAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
}
