<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usermanagementmodel extends Model
{
    //
    protected $table = 'user_management';
    protected $fillable = ['mobileno','username','email','role']; 
}
