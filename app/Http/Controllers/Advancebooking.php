<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advancebookingmodel;
use Illuminate\Support\Facades\DB;

class Advancebooking extends Controller
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
        
        return view('advancebooking');
    }
       
    }

    public function store(Request $request){
       

        $from1 = strtr($request->checktime, '/', '-');
          $checkintime = date('Y-m-d H:i:s', strtotime($from1));

          $from1 = strtr($request->advancebookdate, '/', '-');
          $advancebookdate = date('Y-m-d H:i:s', strtotime($from1));
  
          $from2 = strtr($request->date, '/', '-');
          $checkouttime = date('Y-m-d H:i:s', strtotime($from2));
  
          $Visitercheckinmodel = new Advancebookingmodel;
          $Visitercheckinmodel->visiterid = $request->saveid1;
          $Visitercheckinmodel->men = $request->men;
          $Visitercheckinmodel->woman = $request->women;
          $Visitercheckinmodel->child = $request->child;
          $Visitercheckinmodel->checkintime =$checkintime;
          $Visitercheckinmodel->checkouttime =$checkouttime;
          $Visitercheckinmodel->advancebooktime =$advancebookdate;
          $Visitercheckinmodel->noofday = $request->nodays;
          $Visitercheckinmodel->amount = $request->amount;
          $Visitercheckinmodel->advancepayment = $request->advanceamount;
          $Visitercheckinmodel->mode = $request->amtmode;
          $Visitercheckinmodel->remark = $request->remark;
          $Visitercheckinmodel->canclellation_amt = $request->cancllationamt;
          
        if ($Visitercheckinmodel->save()) {
              return $Visitercheckinmodel->id;
          }
   
  }
  public function showalladvancebook(){
    $data = DB::table('advancebooking')
    ->join('visiter_master', 'visiter_master.id', '=', 'advancebooking.visiterid')
    ->select('advancebooking.*', 'visiter_master.*','advancebooking.id as id')
    ->get();
    
    return response()->json($data);
  }
  public function update(Request $request)
{
  $from1 = strtr($request->checktime, '/', '-');
  $checkintime = date('Y-m-d H:i:s', strtotime($from1));

  $from1 = strtr($request->advancebookdate, '/', '-');
  $advancebookdate = date('Y-m-d H:i:s', strtotime($from1));

  $from2 = strtr($request->date, '/', '-');
  $checkouttime = date('Y-m-d H:i:s', strtotime($from2));
    
    $form_data = array(
        'visiterid'        =>  $request->saveid1,
        'men'    =>  $request->men,
        'woman'        =>  $request->women,
        'child'        =>  $request->child,
        'noofday'    =>  $request->nodays,
        'advancebooktime'    =>  $advancebookdate,
        'checkintime'        =>  $checkintime,
        'checkouttime'        =>  $checkouttime,
        'amount'        =>  $request->amount,
        'advancepayment'        =>  $request->advanceamount,
        'mode'        =>  $request->amtmode,
        'remark'        =>  $request->remark,
        'canclellation_amt'        =>  $request->cancllationamt,

    );
   
    
  $id=  Advancebookingmodel::whereId($request->updateid)->update($form_data);
return response()->json($id);
}
public function cancleadvancebooking($id){
    $data = DB::table('advanceallocateroom')
    ->where('advanceid',$id)
    ->get();
    foreach ($data as  $advanceroom) {
       $roomid=$advanceroom->roomid;
       DB::update('update room_master set status = ? where id = ?',[1,$roomid]);

    }
     DB::table('advanceallocateroom')->where('advanceid',$id)->delete();
   // return DB::table('advancebooking')->where('id',$id)->delete();

}
public function cancellationbooking(Request $request){
  $id=$request->update_id;
  $cancleamt=$request->cancllation_amt;

  
  $data = DB::table('advanceallocateroom')
  ->where('advanceid',$id)
  ->get();
  foreach ($data as  $advanceroom) {
     $roomid=$advanceroom->roomid;
     DB::update('update room_master set status = ? where id = ?',[1,$roomid]);

  }
  DB::table('advanceallocateroom')->where('advanceid',$id)->delete();
  return DB::update('update advancebooking set canclellation_amt = ? where id = ?',[$cancleamt,$id]);

}
public function getadvancebookinginfo($visiter){
 // dd($visiter);
  $result=array();

  $data = DB::table('advancebooking')
  ->where('visiterid',$visiter)
  ->where('status',1)
  ->get();
  $count=count($data);
  if($count >0){
  foreach($data as $getinfo){
      $id=$getinfo->id;
      if($id >0){
        $users = DB::table('categorys')->get();
        foreach($users as $data){
          $id1= $data->id;
          $name= $data->name;
         $rate=$data->rate;
          $roomdata1=array();

          $data = DB::table('advanceallocateroom')
          //   ->join('Checkin_master', 'Checkin_master.visiterid', '=', 'allocateroom.visterid')
             ->join('room_master', 'room_master.id', '=', 'advanceallocateroom.roomid')
             ->where('room_master.categoryid', '=', $id1)
             ->where('advanceallocateroom.visterid', '=', $visiter)
             ->where('advanceallocateroom.advanceid', '=', $id)
             ->where('advanceallocateroom.status', '=', 1)
              ->select('advanceallocateroom.*', 'room_master.*')
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
      }

  }

  return $result;
}else{
  return 0;
}
 
}
}
