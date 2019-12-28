<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_master extends Model
{
    protected $table = "user_management";
    protected $fillable = [
        'role', 'username', 'mobileno', 'email'
    ];
}