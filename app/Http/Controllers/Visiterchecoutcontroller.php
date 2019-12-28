<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Visiterchecoutmodel;
class Visiterchecoutcontroller extends Controller
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
    }else{

        return view('visitercheckout');
    }

    }

    public function getcheckinvisiterdata($vid){

        $result=array();
        $users = DB::table('categorys')->get();
      foreach($users as $data){
        $id1= $data->id;
        $name= $data->name;
       $rate=$data->rate;
        $roomdata1=array();

           $data = DB::table('allocateroom')
             //   ->join('Checkin_master', 'Checkin_master.visiterid', '=', 'allocateroom.visterid')
                ->join('room_master', 'room_master.id', '=', 'allocateroom.roomid')
                ->where('room_master.categoryid', '=', $id1)
                ->where('allocateroom.visterid', '=', $vid)
                ->where('allocateroom.status', '=',1)
               // ->groupBy('room_master.id')
                ->select('allocateroom.*', 'room_master.*')
                ->get();
              foreach($data as $getrom){
                $roomno=$getrom->roomno;
                $visterid=$getrom->visterid;
                $roomid=$getrom->roomid;
                $roomname=$getrom->roomname;
                $description=$getrom->description;
                $roomdata1[]=array(
                  'roomno'=>$roomno,
                  'roomid'=>$roomid,
                  'description'=>$description,
                  'roomname'=>$roomname,
                  'visterid'=>$visterid,
                );
              }


            $result[]=array(

               'cateid'=>$id1,
              'catname'=>$name,
              'roomdata'=>$roomdata1,
              'rate'=>$rate,
            );

      }
      return response()->json($result);
    }
    public function checkoutroomwise($roomno){

        $result=array();
        $roomdata = DB::table('room_master')->join('categorys', 'categorys.id', '=', 'room_master.categoryid') ->where('roomno', '=',$roomno)->select('room_master.*', 'categorys.name as catergory','categorys.rate')->get();
        foreach($roomdata as $data){
            $id1= $data->id;
            $categoryid= $data->categoryid;
            $categoryname= $data->catergory;
            $rate= $data->rate;
            $roomname= $data->roomname;
            $roomno=$data->roomno;
            $visterid='';
            $vistername='';
            $checkintime="";
            $cheouttime="";
            $allocatedata= DB::table('allocateroom') ->where('roomid', '=',$id1)->where('status', '=',1)->get();
                if($allocatedata->count()>0){
                   foreach($allocatedata as $allocatedata1){
                    $visterid=$allocatedata1->visterid;
                   }
                   if($visterid >0){
                    $visterdata= DB::table('visiter_master') ->where('id', '=',$visterid)->get();
                    foreach($visterdata as $getvister){
                        $vistername=$getvister->visitername;
                    }
                    $checkvisiter= DB::table('Checkin_master') ->where('visiterid', '=',$visterid)->get();
                    foreach($checkvisiter as $checkvisterdata){
                        $checkintime=$checkvisterdata->checkintime;
                        $cheouttime=$checkvisterdata->checkouttime;
                    }

                }
                   $result[]=array(
                    'categoryid'=>$categoryid,
                    'categoryname'=>$categoryname,
                    'visterid'=>$visterid,
                    'rate'=>$rate,
                    'vistername'=>$vistername,
                    'checkintime'=>$checkintime,
                    'cheouttime'=>$cheouttime,
                    'roomno'=> $roomno,
                    'roomid'=> $id1,
                   );
                }




        }
        return response()->json($result);

    }
    public function checkoutvistertime($visterid){
        $checkvisiter= DB::table('Checkin_master') ->where('visiterid', '=',$visterid)->where('status', '=',1)->get();
        return response()->json($checkvisiter);

    }
    public function store(Request $request){

      $from1 = strtr($request->checktime, '/', '-');
        $checkintime = date('Y-m-d H:i:s', strtotime($from1));

        $from2 = strtr($request->checkouttime, '/', '-');
        $checkouttime = date('Y-m-d H:i:s', strtotime($from2));

        $Visiterchecoutmodel = new Visiterchecoutmodel;
        $Visiterchecoutmodel->visterid = $request->visiterid;
        $Visiterchecoutmodel->visternam = $request->visitorname;
        $Visiterchecoutmodel->checkintime = $checkintime;
        $Visiterchecoutmodel->checkouttime = $checkouttime;
        $Visiterchecoutmodel->totalamout = $request->amount;
        $Visiterchecoutmodel->mode = $request->amtmode;
        $Visiterchecoutmodel->transactiondetal = $request->transactiondetalis;
       if ($Visiterchecoutmodel->save()) {
            return $Visiterchecoutmodel->id;
        }

}
public function updateallocateroom($rid,$visterid,$checkoutid){

    DB::update('update room_master set status = ? where id = ?',[1,$rid]);
    DB::update('update allocate_service set status = ? where roomid = ? And visterid=?',[0,$rid,$visterid]);
    $result= DB::update('update allocateroom set status = ?,checkoutid =? where roomid = ? And visterid = ? And status= ?',[0,$checkoutid,$rid,$visterid,1]);
    $data1 = DB::table('allocateroom')->where('visterid',$visterid)->get();
    foreach($data1 as $allocatedata){
        $visitercheckinid=$allocatedata->visitercheckinid;

       $data2= DB::table('allocateroom')->where('visitercheckinid',$visitercheckinid)->whereNull('checkoutid')->get();
        $count=count($data2);
        if($count >0){

        }else{
            DB::update('update Checkin_master set status = ? where id = ?',[0,$visitercheckinid]);
        }
    }


    return response()->json($result);
}
public function getallcheckoutuser(){
    $data = DB::table('vistercheckout_master')
    ->join('visiter_master', 'visiter_master.id', '=', 'vistercheckout_master.visterid')
    ->select('vistercheckout_master.*', 'visiter_master.visitername','vistercheckout_master.id as id')
    ->get();

    return response()->json($data);
}
public function geteditallocateroom($vid,$checkid){
    $result=array();
    $users = DB::table('categorys')->get();
  foreach($users as $data){
    $id1= $data->id;
    $name= $data->name;
   $rate=$data->rate;
    $roomdata1=array();

       $data = DB::table('allocateroom')
         //   ->join('Checkin_master', 'Checkin_master.visiterid', '=', 'allocateroom.visterid')
            ->join('room_master', 'room_master.id', '=', 'allocateroom.roomid')
            ->where('room_master.categoryid', '=', $id1)
            ->where('allocateroom.visterid', '=', $vid)
            ->where('allocateroom.checkoutid', '=', $checkid)
            ->where('allocateroom.status', '=',0)
            ->select('allocateroom.*', 'room_master.*')
            ->get();
          foreach($data as $getrom){
            $roomno=$getrom->roomno;
            $visterid=$getrom->visterid;
            $roomid=$getrom->roomid;
            $roomname=$getrom->roomname;
            $description=$getrom->description;
            $roomdata1[]=array(
              'roomno'=>$roomno,
              'roomid'=>$roomid,
              'description'=>$description,
              'roomname'=>$roomname,
              'visterid'=>$visterid,
            );
          }


        $result[]=array(

           'cateid'=>$id1,
          'catname'=>$name,
          'roomdata'=>$roomdata1,
          'rate'=>$rate,
        );

  }
  return response()->json($result);
}
public function getlastcheckinvisiter(){
  $result=array();
  $checkindata = DB::table('visiter_master')->orderBy('id', 'DESC')->get();



  foreach($checkindata as $visierinfo){
    $visitrid=$visierinfo->id;
    $visitername=$visierinfo->visitername;
    $lastname=$visierinfo->lastname;
    $mobileno=$visierinfo->mobileno;
    $address=$visierinfo->address;
    $emailid=$visierinfo->emailid;
    $c_detalis=$visierinfo->c_detalis;
    $desighnation=$visierinfo->desighnation;
    $c_name=$visierinfo->c_name;
    $c_url=$visierinfo->c_url;
    $allocatedata = DB::table('allocateroom')
    ->where('allocateroom.visterid', $visitrid)
    ->whereNull('checkoutid')
    ->orderBy('id', 'DESC')->get();

    $count=count($allocatedata);

    if($count >0){


        $result[]=array(
          'id'=>$visitrid,
          'visitername'=>$visitername,
          'lastname'=>$lastname,
          'mobileno'=>$mobileno,
          'address'=>$address,
          'emailid'=>$emailid,
          'c_detalis'=>$c_detalis,
          'desighnation'=>$desighnation,
          'c_name'=>$c_name,
          'c_url'=>$c_url,

        );
       }
    }



  return $result;
}
function getvisitorserviceinformation($id){
    $result=array();
    $checkdata = DB::table('Checkin_master')->where('id',$id)->get();
    foreach( $checkdata as $checkindata){
        $visterid=$checkindata->visiterid;
    }

    if($visterid > 0){
    $data1 = DB::table('allocateroom')->where('visterid',$visterid)->whereNull('checkoutid')->orderBy('id', 'desc')->get();
    foreach($data1 as $allocatedata){
        $visterid=$allocatedata->visterid;
        $roomid=$allocatedata->roomid;
        if($roomid >0){

            $data2 = DB::table('allocate_service')->where('visterid',$visterid)->where('roomid',$roomid)->get();
            foreach($data2 as $allocatedata){
                $alocateid=$allocatedata->id;


                $data3 = DB::table('allocate_servicedetalis')
                ->join('extra_service', 'extra_service.id', '=', 'allocate_servicedetalis.serviceid')
                ->select('allocate_servicedetalis.*', 'extra_service.servicename')
                ->where('allocate_sid',$alocateid)->get();

                foreach($data3 as $getservicedetalis){
                        $sum=0;
                        $rate=$getservicedetalis->rate;
                        $qty=$getservicedetalis->qty;
                        $servicename1=$getservicedetalis->servicename;
                        $serviceid=$getservicedetalis->serviceid;
                        $datetime=$getservicedetalis->datetime;
                        if($rate > 0 && $qty > 0){
                            $sum=$rate * $qty;
                        }
                        $result[]=array(
                            'rate'=>$rate,
                            'qty'=>$qty,
                            'servicename'=>$servicename1,
                            'serviceid'=>$serviceid,
                            'sum'=>$sum,
                            'datetimedata'=>$datetime,
                        );
                }
            }
        }


    }
}
    return $result;

}
function roomwiseservices(Request $request){
    $result=array();
    $data2 = DB::table('allocate_service')->where('visterid',$request->visterid)->where('roomid',$request->roomid)->get();
    foreach($data2 as $allocatedata){
        $alocateid=$allocatedata->id;


        $data3 = DB::table('allocate_servicedetalis')
        ->join('extra_service', 'extra_service.id', '=', 'allocate_servicedetalis.serviceid')
        ->select('allocate_servicedetalis.*', 'extra_service.servicename')
        ->where('allocate_sid',$alocateid)->get();

        foreach($data3 as $getservicedetalis){
                $sum=0;
                $rate=$getservicedetalis->rate;
                $qty=$getservicedetalis->qty;
                $servicename1=$getservicedetalis->servicename;
                $serviceid=$getservicedetalis->serviceid;
                $datetime=$getservicedetalis->datetime;
                if($rate > 0 && $qty > 0){
                    $sum=$rate * $qty;
                }
                $result[]=array(
                    'rate'=>$rate,
                    'qty'=>$qty,
                    'servicename'=>$servicename1,
                    'serviceid'=>$serviceid,
                    'sum'=>$sum,
                    'datetimedata'=>$datetime,
                );
        }
    }
    return $result;
}

}
