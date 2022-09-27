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
        'name', 'email', 'password', 'permissions_id',
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
    public function category(){
        return $this->hasMany('App\Category');
    }
    public function permission(){
        return $this->hasMany('App\Permission');
    }
    public function team(){
        // return $this->belongsTo('app\Team', 'tema_id', 'id');
        return $this->hasMany('App\Team');
    }
    public function group()
    {
        // return $this->belongsTo('App\group', 'team_num', 'id');
        return $this->belongsTo('App\group');
    }
}
