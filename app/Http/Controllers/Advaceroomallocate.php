<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advanceromoallocatemodel;
use Illuminate\Support\Facades\DB;

class Advaceroomallocate extends Controller
{
    //
    public function index(){

    }
    public function store(Request $request){
       
       
      DB::update('update room_master set status = ? where id = ?',[3,$request->roomid]);

        $from1 = strtr($request->checkintime, '/', '-');
        $checkintime = date('Y-m-d H:i:s', strtotime($from1));

        $from2 = strtr($request->checkouttime, '/', '-');
        $checkouttime = date('Y-m-d H:i:s', strtotime($from2));


        $data = DB::table('advanceallocateroom')->where('advanceid',$request->visitercheckinid);
        $count=$data->count();
        if($count >0){

          $data2 = DB::table('advanceallocateroom')
          ->where('advanceid',$request->visitercheckinid)
          ->where('roomid',$request->roomid)
          ->where('status',0);
          $count2=$data2->count();
          if($count2 >0){
            return 0;
          }else{
             DB::table('advanceallocateroom')
             ->where('advanceid',$request->visitercheckinid)
             ->where('roomid',$request->roomid)
             ->delete();
             //$data1 = Allocateroommodel::where('visitercheckinid',$request->visitercheckinid) ->where('roomid',$request->roomid);
             //$data1->delete();
            $Allocateroommodel = new Advanceromoallocatemodel;
            $Allocateroommodel->advanceid = $request->visitercheckinid;
            $Allocateroommodel->visterid = $request->visiterid;
            $Allocateroommodel->roomid = $request->roomid;
            $Allocateroommodel->checkintime = $checkintime;
            $Allocateroommodel->checkouttime = $checkouttime;
            $Allocateroommodel->roomrate = $request->roomrate;
        
            if ($Allocateroommodel->save()) {
                return $Allocateroommodel->id;
            
            }
          }
         

         
        }else{
          $Allocateroommodel = new Advanceromoallocatemodel;
          $Allocateroommodel->advanceid = $request->visitercheckinid;
          $Allocateroommodel->visterid = $request->visiterid;
          $Allocateroommodel->roomid = $request->roomid;
          $Allocateroommodel->checkintime = $checkintime;
          $Allocateroommodel->checkouttime = $checkouttime;
          $Allocateroommodel->roomrate = $request->roomrate;
      
          if ($Allocateroommodel->save()) {
              return $Allocateroommodel->id;
          
          }
        }

}
public function advancegetvisallocateroom($visterid,$id){

  $result=array();
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
          ->where('advanceallocateroom.visterid', '=', $visterid)
          ->where('advanceallocateroom.advanceid', '=', $id)
          //->where('allocateroom.status', '=',1)
         // ->groupBy('room_master.id')
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
return response()->json($result);
}
// public function deleteallocateroom($id){
  
//   $data=DB::table('advanceallocateroom')->where('visitercheckinid',$id)->get();
//   foreach($data as $getrom){
//     $roomid=$getrom->roomid;
//     DB::update('update room_master set status = ? where id = ?',[1,$roomid]);
//   }
//   return DB::table('advanceallocateroom')->where('visitercheckinid',$id)->delete();
// }
}
