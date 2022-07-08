<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    public function category(){
        return $this->belongsTo('App\category','type_id_1', 'id');
        return $this->belongsTo('App\category','type_id_2', 'id');
    }
    public function user(){
        return $this->belongsTo('App\user', 'user_id', 'id');
    }
}
