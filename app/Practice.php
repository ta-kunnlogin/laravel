<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    public $primaryKey = 'practice_id';

    public function category1(){
        return $this->belongsTo('App\category','type_id_1', 'training_id');
    }
    public function category2(){
        return $this->belongsTo('App\category', 'type_id_2', 'training_id');
    }
    // public function user(){
    //     return $this->belongsTo('App\user', 'user_id', 'id');
    // }

    // public function team(){
    //     return $this->belongsTo('app\Team', 'id', 'user_id');
    // }
    public function group(){
        return $this->belongsTo('app/group', 'team_num', 'group_id');
    }
}
