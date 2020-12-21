<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'address_1',
        'address_2',
        'city',
        'state',
        'zip',
        'phone_1',
        'phone_2',
        'email',
        'geolocation'
    ];

    public function interactions()
    {
        return $this->hasMany('App\Models\Interaction');
    }

}
