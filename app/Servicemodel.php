<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicemodel extends Model
{
    //
    protected $table = 'extra_service';
    protected $fillable = ['servicename','unit','rate']; 
}
