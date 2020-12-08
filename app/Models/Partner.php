<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'name'
    ];

    public function articles()
    {
        return $this->belongsToMany('App\Models\Article');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

}
