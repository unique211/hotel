<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loginmastermodel extends Model
{
    //
    protected $table = 'login_master';
    protected $fillable = ['uid','userid','password','role']; 
}
