<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'positions';

    protected $fillable = [
        'title', 'institute_id', 'user_id'
    ];

    public function __construct(array $data = array())
    {
        parent::__construct($data);
        foreach($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
