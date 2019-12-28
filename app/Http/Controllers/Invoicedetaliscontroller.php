<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoicedetailsmodel;
use Illuminate\Support\Facades\DB;
use App\Allocateroommodel;
class Invoicedetaliscontroller extends Controller
{
    //
    public function index(Request $request){

      
    }

    public function store(Request $request){
       
        DB::update('update allocateroom set invoiceid = ? where visterid = ? And roomid= ? And checkoutid= ?',[$request->invioceid,$request->visterid,$request->roomid,$request->checkoutid]);
       
        $from1 = strtr($request->checkintime, '/', '-');
        $checkintime = date('Y-m-d H:i:s', strtotime($from1));

        $from2 = strtr($request->checkouttime, '/', '-');
        $checkouttime = date('Y-m-d H:i:s', strtotime($from2));
       
        $Invoicedetailsmodel = new Invoicedetailsmodel;
        $Invoicedetailsmodel->invoiceid = $request->invioceid;
        $Invoicedetailsmodel->roomid = $request->roomid;
        $Invoicedetailsmodel->categoryid = $request->categoryid;
        $Invoicedetailsmodel->checkintime = $checkintime;
        $Invoicedetailsmodel->checkoutime = $checkouttime;
        $Invoicedetailsmodel->checkoutid = $request->checkoutid;
        $Invoicedetailsmodel->save();

        return $Invoicedetailsmodel;

     
    }
    
}
