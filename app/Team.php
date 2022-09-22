<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public $timestamps = false;
    public $primaryKey = 'user_id';

    protected $fillable = ['user_id', 'team_num'];

    public function group()
    {
        return $this->belongsTo('App\group', 'team_num','group_id');
    }
}
