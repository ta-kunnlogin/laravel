<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    // use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'date',
        'schedule',
        'user_id',
    ];
}
