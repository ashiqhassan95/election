<?php

namespace App;

use App\Models\Standard;
use App\Models\Candidate;
use App\Models\Institute;
use App\Models\Voter;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable //implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'institute_id'. 'role', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function standards()
    {
        return $this->hasMany(Standard::class);
    }

    public function voters()
    {
        return $this->hasMany(Voter::class);
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function getIsActive()
    {
        if ($this['is_active'] == 1) return 'true';
        return 'false';
    }

    public function getRole()
    {
        if ($this['role'] == '0') return 'Super Admin';
        if ($this['role'] == '1') return 'Admin';
        if ($this['role'] == '2') return 'Viewer';
    }
}
