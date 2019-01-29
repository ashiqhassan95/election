<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    protected $table = 'elections';

    protected $fillable = [
        'title', 'poll_start_at', 'poll_end_at',
        'type', 'url', 'institute_id', 'user_id'
    ];

    protected $with = ['user'];

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
        if($this['type'] == 0)
            return 'Presidential';
        else if($this['type'] == 1)
            return 'Parliamentary';
        else
            return 'Unknown';
    }
}
