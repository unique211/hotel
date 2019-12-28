<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckinreportController extends Controller
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
                return view('checkinreport');
            }
            
           
        }
        public function store(Request $request){
               
          

           
           
    }
    public function getcheckcustomer($formdate,$todate){
        $result=array();
        $data = DB::table('Checkin_master')->whereDate('checkintime', '>=',$formdate)->whereDate('checkintime', '<=',$todate)->get();
        foreach($data as $cheindata){
            $date=$cheindata->checkintime;
            $visiterid=$cheindata->visiterid;
           

            $vistername="";
            $id=$cheindata->id;
            $data1 = DB::table('visiter_master')->where('id',$visiterid)->get();
            foreach($data1 as $visterdata){
                $vistername=$visterdata->visitername;
            }
            $result[]=array(
                'date'=>$date,
                'visiterid'=>$visiterid,
                'visitername'=>$vistername,
                'id'=>$id,
            );
        }
        return response()->json($result);
    }
    public function getvisitorfullinforamtion(Request $request){
      //  $result=array();



        $vistername='';
        $mobileno='';
        $address='';
        $email='';
        $lastname='';

       $rvisitorid= $request->visiterid;
       $rvisitorcheckindate= $request->visitorcheckindate;

        $men='';
        $woman='';
        $child='';
        $chektime='';
       $data2 = DB::table('Checkin_master')->where('visiterid', '=',$rvisitorid)->where('checkintime', '=',$rvisitorcheckindate)->get();
       foreach($data2 as $checkindata){
           $men=$checkindata->men;
           $woman=$checkindata->woman;
           $child=$checkindata->child;
           $chektime=$checkindata->checkintime;
          

       }
        
        $roominfo=array();
        $checkoutinfodata=array();
        $inviocegetdata=array();
        $data = DB::table('visiter_master')->where('id', '=',$request->visiterid)->get();
        foreach($data as $visitordata){
            $vistername=$visitordata->visitername;
            $lastname=$visitordata->lastname;
            $mobileno=$visitordata->mobileno;
            $address=$visitordata->address;
            $email=$visitordata->emailid;

        }
        $allocate = $data = DB::table('allocateroom')
        ->select('allocateroom.*', 'room_master.*')
        ->join('room_master', 'room_master.id', '=', 'allocateroom.roomid')
        ->where('allocateroom.visterid', '=',$request->visiterid)
        ->where('allocateroom.checkintime', '=',$request->visitorcheckindate)
        ->get();
      foreach($allocate as $allocatedata){
           
            $visterid=$allocatedata->visterid;
            $roomid=$allocatedata->roomid;
            $roomname=$allocatedata->roomname;
            $roomrate=$allocatedata->roomrate;
            $roomno=$allocatedata->roomno;
            $categoryid=$allocatedata->categoryid;
            $checkputid=$allocatedata->checkoutid;
            $invoiceid=$allocatedata->invoiceid;
            $checkouttime='';
            $invoicedata='';
            $invoiceno='';
            $invoicedate='';
            $totalamt='';

            $checkoutdata= DB::table('vistercheckout_master')
            ->where('id',$checkputid)
            ->get();
            foreach($checkoutdata as $checkdata){
                $checkouttime=$checkdata->checkouttime;

            }

            $invoicedata= DB::table('invoice_master')
            ->where('id',$invoiceid)
            ->get();
            foreach($invoicedata as $invoiceinfo){
                $invoiceno=$invoiceinfo->invoiceno;
                $invoicedate=$invoiceinfo->invoicedate;
                $totalamt=$invoiceinfo->totalamt;

            }
          
            $roominfo[]=array(
              'roomno'=>$roomno,
              'roomid'=>$roomid,
            'roomrate'=>$roomrate,
              'roomname'=>$roomname,
              'visterid'=>$visterid,
             
            );
        }
       

        


        $allocate1 = $data = DB::table('allocateroom')
        ->select('allocateroom.*', 'room_master.*')
        ->join('room_master', 'room_master.id', '=', 'allocateroom.roomid')
        ->where('allocateroom.visterid',$rvisitorid)
        ->where('allocateroom.checkintime',$rvisitorcheckindate)
        ->orderBy('allocateroom.id', 'asc')
        ->get();
      foreach($allocate1 as $allocatedata){
           
            $visterid=$allocatedata->visterid;
            $roomid=$allocatedata->roomid;
            $roomname=$allocatedata->roomname;
            $roomrate=$allocatedata->roomrate;
            $roomno=$allocatedata->roomno;
            $categoryid=$allocatedata->categoryid;
            $checkputid=$allocatedata->checkoutid;
            $invoiceid=$allocatedata->invoiceid;
            $checkouttime='';
            $invoicedata='';
            $invoiceno='';
            $invoicedate='';
            $totalamt='';
            

          
            $checkoutdata= DB::table('vistercheckout_master')
            ->where('id',$checkputid)
            ->get();
            foreach($checkoutdata as $checkdata){
                $checkouttime=$checkdata->checkouttime;
               

            }
           
  
            $checkoutinfodata[]=array(
              'roomno'=>$roomno,
              'roomid'=>$roomid,
            'roomrate'=>$roomrate,
              'roomname'=>$roomname,
              'visterid'=>$visterid,
              'checkouttime'=>$checkouttime,
          
            );
            $checkid= $checkputid;
        }

        $inid= 0;

       
        $allocate = $data = DB::table('allocateroom')
        ->select('allocateroom.*', 'room_master.*')
        ->join('room_master', 'room_master.id', '=', 'allocateroom.roomid')
        ->where('allocateroom.visterid', '=',$request->visiterid)
        ->where('allocateroom.checkintime', '=',$request->visitorcheckindate)
        ->orderBy('allocateroom.id', 'asc')
        ->get();
      foreach($allocate as $allocatedata){
           
            $visterid=$allocatedata->visterid;
            $roomid=$allocatedata->roomid;
            $roomname=$allocatedata->roomname;
            $roomrate=$allocatedata->roomrate;
            $roomno=$allocatedata->roomno;
            $categoryid=$allocatedata->categoryid;
            $checkputid=$allocatedata->checkoutid;
            $invoiceid=$allocatedata->invoiceid;
            $checkouttime='';
            $invoicedata='';
            $invoiceno='';
            $invoicedate='';
            $totalamt='';
            

            if($inid !=$invoiceid){
                $invoicedata= DB::table('invoice_master')
                ->where('id',$invoiceid)
                //->groupBy('invoice_master.id')
                ->get();
                foreach($invoicedata as $invoiceinfo){
                    $invoiceno=$invoiceinfo->invoiceno;
                    $invoicedate=$invoiceinfo->invoicedate;
                    $totalamt=$invoiceinfo->totalamt;
         
                }
            }
            
           
  
            $inviocegetdata[]=array(
              'roomno'=>$roomno,
              'roomid'=>$roomid,
            'roomrate'=>$roomrate,
              'roomname'=>$roomname,
              'visterid'=>$visterid,
              'checkouttime'=>$checkouttime,
              'totalamt'=>$totalamt,
              'invoiceno'=>$invoiceno,
              'invoicedate'=>$invoicedate,
          
            );
            $inid= $invoiceid;
        }
 
        $result[]=array(
            'visitername'=>$vistername,
            'lastname'=>$lastname,
            'mobileno'=>$mobileno,
            'address'=>$address,
            'email'=>$email,
            'men'=>$men,
            'woman'=>$woman,
            'chid'=>$child,
            'roomdata'=>$roominfo,
            'chektime'=>$chektime,
            'checkoutinfo'=>$checkoutinfodata,
            'invoice'=>$inviocegetdata,
        );

        return $result;


    }
}
