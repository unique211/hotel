<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Dashboardcontroller extends Controller
{
    //
    public function __construct()
{
    $this->middleware('usersession');
}

    public function index(Request $request){

        if (!$request->session()->exists('userid')) {
            // user value cannot be found in session

            return redirect('/');

        } else{
            $data = DB::table('Checkin_master')->whereDate('checkintime',date("Y-m-d"))->get();
            $todaycheckin=count($data);



            $allvis = DB::table('Checkin_master')->get();
            $allvisiter=count($allvis);


            $data = DB::table('vistercheckout_master')->whereDate('checkouttime',date("Y-m-d"))->get();
            $todaycheckout=count($data);

            $allcheckout = DB::table('vistercheckout_master')->get();
            $allvisitercheckout=count($allcheckout);

            $invoice = DB::table('invoice_master')->where('invoicedate',date("Y-m-d"))->get();
            $todayinvoice=count($invoice);


            $totalinvoice = DB::table('invoice_master')->get();
            $allinvoice=count($totalinvoice);

            $data['todaycheckin']=$todaycheckin;
            $data['allvisiter']=$allvisiter;
            $data['todaycheckout']=$todaycheckout;
            $data['allvisitercheckout']=$allvisitercheckout;
            $data['todayinvoice']=$todayinvoice;
            $data['allinvoice']=$allinvoice;
            return view('dashboard',$data);
        }
    }
    public function getdashboarddata(){


    }
}
