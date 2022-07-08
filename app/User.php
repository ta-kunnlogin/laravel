<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_flg','team_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function practice(){
        return $this->hasMany('App\Practice');
    }
    public function condition(){
        return $this->hasMany('App\Condition');
    }
    public function team(){
        return $this->belongsTo('App\Team', 'team_id', 'id');
    }
    public function position(){
        return $this->belongsTo('App\Position', 'user_flg', 'id');
    }
}
