<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roommastermodel extends Model
{
    //
    protected $table = 'room_master';
    protected $fillable = ['roomno', 'roomname', 'categoryid'];
}
