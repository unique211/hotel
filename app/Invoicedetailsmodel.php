<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoicedetailsmodel extends Model
{
    //
    protected $table = 'invoice_detalis';
    protected $fillable = ['invoiceid','roomid','categoryid','checkintime','checkoutime'];
}
