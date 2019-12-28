<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Visitercheckinmodel;
use App\Exceptions\CustomException;
class Visitercheckincontroller extends Controller
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
        return view('visitercheckin');
    }

    }
    public function store(Request $request){


      $from1 = strtr($request->checktime, '/', '-');
        $checkintime = date('Y-m-d H:i:s', strtotime($from1));
        $checkdate=date('Y-m-d',strtotime($from1));

        $data1 = DB::table('advancebooking')->whereDate('checkintime', '=',$checkdate)->where('visiterid', '=',$request->saveid1)->get();
        $count=count($data1);

        if($count > 0){

          foreach($data1 as $advancebookdata){
            $aid=$advancebookdata->id;

             DB::update('update advancebooking set status = ? where id = ?',[0,$aid]);

          }
        }


        $from2 = strtr($request->date, '/', '-');
        $checkouttime = date('Y-m-d H:i:s', strtotime($from2));

        $Visitercheckinmodel = new Visitercheckinmodel;
        $Visitercheckinmodel->visiterid = $request->saveid1;
        $Visitercheckinmodel->men = $request->men;
        $Visitercheckinmodel->woman = $request->women;
        $Visitercheckinmodel->child = $request->child;
        $Visitercheckinmodel->checkintime =$checkintime;
        $Visitercheckinmodel->checkouttime =$checkouttime;
        $Visitercheckinmodel->noofday = $request->nodays;
        $Visitercheckinmodel->amount = $request->amount;
        $Visitercheckinmodel->advancepayment = $request->advanceamount;
        $Visitercheckinmodel->mode = $request->amtmode;
        $Visitercheckinmodel->remark = $request->remark;

      if ($Visitercheckinmodel->save()) {
            return $Visitercheckinmodel->id;
        }

}
public function showalldata(){
  //  throw new \App\Exceptions\CustomException('Something Went Wrong.');
  $result=array();

    $data = DB::table('Checkin_master')
    ->join('visiter_master', 'visiter_master.id', '=', 'Checkin_master.visiterid')
    ->where('Checkin_master.status','1')
    ->select('Checkin_master.*', 'visiter_master.*','Checkin_master.id as id')
    ->get();

    return response()->json($data);
}
public function update(Request $request)
{
  $from1 = strtr($request->checktime, '/', '-');
  $checkintime = date('Y-m-d H:i:s', strtotime($from1));

  $from2 = strtr($request->date, '/', '-');
  $checkouttime = date('Y-m-d H:i:s', strtotime($from2));

    $form_data = array(
        'visiterid'        =>  $request->saveid1,
        'men'    =>  $request->men,
        'woman'        =>  $request->women,
        'child'        =>  $request->child,
        'noofday'    =>  $request->nodays,
        'checkintime'        =>  $checkintime,
        'checkouttime'        =>  $checkouttime,
        'amount'        =>  $request->amount,
        'advancepayment'        =>  $request->advanceamount,
        'mode'        =>  $request->amtmode,
        'remark'        =>  $request->remark,

    );


  $id=  Visitercheckinmodel::whereId($request->updateid)->update($form_data);



    return response()->json($id);
}
public function getallroomdatainfo($cateid){

  $data1 = DB::table('room_master')->where('categoryid',$cateid)->where('status',1)->get();

  return response()->json($data1);
}
public function getcheckout($id){
  $title['id']=$id;


  return view('visitercheckout',$title);
}
public function getvischeckinginformation($visiter){
  $result=array();
  $data = DB::table('Checkin_master')->where('id',$visiter)->where('status',1)->get();

  foreach($data as $visiterdatachechindata){
    $men=$visiterdatachechindata->men;
    $visiterid=$visiterdatachechindata->visiterid;
    $checkintime=$visiterdatachechindata->checkintime;
    $checkouttime=$visiterdatachechindata->checkouttime;
    $id=$visiterdatachechindata->id;
    $amount=$visiterdatachechindata->amount;
    $visitername='';
    $lastname='';
    $allocateroom=array();
    $data4 = DB::table('visiter_master')->where('id',$visiterid)->get();
    foreach($data4 as $visiterinfo){
      $visitername=$visiterinfo->visitername;
      $lastname=$visiterinfo->lastname;
    }

  $data1 = DB::table('allocateroom')->where('visterid',$visiterid)->whereNull('checkoutid')->get();
  foreach($data1 as $allocateroominfo){
    $roomid=$allocateroominfo->roomid;
    $roomrate=$allocateroominfo->roomrate;
    $visitercheckinid=$allocateroominfo->visitercheckinid;
    $vistercheckintime=$allocateroominfo->checkintime;
    $roomno='';
    $categoryid='';

    $data2 = DB::table('room_master')->where('id',$roomid)->get();
    foreach($data2 as $roominfo){
      $roomno=$roominfo->roomno;
      $categoryid=$roominfo->categoryid;



    }
    $allocateroom[]=array(
      'roomno'=>$roomno,
      'categoryid'=>$categoryid,
      'roomid'=>$roomid,
      'roomrate'=>$roomrate,
      'visitercheckinid'=>$visitercheckinid,
      'vistercheckintime'=>$vistercheckintime,
    );

  }
  $result[]=array(
    'men'=>$men,
    'visiter'=>$visiterid,
    'checkintime'=>$checkintime,
    'checkouttime'=>$checkouttime,
    'roomdata'=>$allocateroom,
    'vistername'=>$visitername,
    'lastname'=>$lastname,
    'id'=>$id,
  );

  }
  return $result;

}
public function checkinupdatestatus($id){
  DB::update('update Checkin_master set status = ? where id = ?',[0,$id]);
}

public function deletevisitorcheckin(Request $request){

  $data=DB::table('allocateroom')->where('visitercheckinid', $request->id)->get();
  $count=count($data);

  if($count >0){
    foreach($data as $getallocatedata){
       $roomid=$getallocatedata->roomid;

   DB::update('update room_master set status = ? where id = ?',[1,$roomid]);

    }
  }


  DB::table('allocateroom')->where('visitercheckinid', $request->id)->delete();
  $customer = Visitercheckinmodel::where('id', $request->id)->delete();
  return response()->json($customer);

}

}
