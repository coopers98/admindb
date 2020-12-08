<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function partners()
    {
        return $this->belongsToMany('App\Models\Partner');
    }

    public function articles()
    {
        return Article::select('articles.*')
                      ->join('article_partner', 'articles.id', 'article_partner.article_id')
                      ->join('partner_user', 'partner_user.partner_id', 'article_partner.partner_id')
                      ->where('user_id', $this->id)
                      ->get();

    }
}
