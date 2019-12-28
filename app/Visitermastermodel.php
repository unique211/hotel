<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitermastermodel extends Model
{
    //
    protected $table = 'visiter_master';
    protected $fillable = [
        'visitername', 'address', 'mobileno',
    ];
}
