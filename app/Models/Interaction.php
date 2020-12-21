<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    protected $fillable = [
        'type',
        'interaction_timestamp',
        'outcome',
        'geolocation',
        'profile_id'
    ];

    protected $dates = [
        'interaction_timestamp'
    ];

    public function interactions()
    {
        return $this->belongsTo('App\Models\Profile');
    }

}
