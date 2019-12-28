<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login_master extends Model
{
    protected $table = "login_master";
    protected $fillable = [
        'role', 'user_id', 'password', 'ref_id', 'expire_date'
    ];
}