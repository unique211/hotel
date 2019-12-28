<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoicemodel extends Model
{
    //
    protected $table = 'invoice_master';
    protected $fillable = ['invoicedate','visiterid'];
}
