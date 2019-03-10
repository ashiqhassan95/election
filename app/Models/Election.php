<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    protected $table = 'elections';

    protected $fillable = [
        'title', 'poll_start_at', 'poll_end_at', 'status',
        'type', 'url', 'institute_id', 'user_id'
    ];

    protected $dates = [
        'poll_start_at', 'poll_end_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function getType()
    {
        switch ($this['type']) {
            case 0 :
                return 'Presidential';
            case 1 :
                return 'Parliamentary';
        }
    }

    public function getStatus()
    {
        switch ($this['status']) {
            case 0 :
                return 'Building';
            case 1 :
                return 'Running';
            case  2:
                return 'Completed';
        }
    }
}
