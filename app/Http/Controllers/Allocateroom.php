<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Allocateroommodel;
use Illuminate\Support\Facades\DB;
class Allocateroom extends Controller
{
    //

    public function index(){

    }
    public function store(Request $request){
       
       
      DB::update('update room_master set status = ? where id = ?',[2,$request->roomid]);

        $from1 = strtr($request->checkintime, '/', '-');
        $checkintime = date('Y-m-d H:i:s', strtotime($from1));

        $from2 = strtr($request->checkouttime, '/', '-');
        $checkouttime = date('Y-m-d H:i:s', strtotime($from2));


        $data = DB::table('allocateroom')->where('visitercheckinid',$request->visitercheckinid);
        $count=$data->count();
        if($count >0){

          $data2 = DB::table('allocateroom')
          ->where('visitercheckinid',$request->visitercheckinid)
          ->where('roomid',$request->roomid)
          ->where('status',0);
          $count2=$data2->count();
          if($count2 >0){
            return 0;
          }else{
           
            // $data1 = Allocateroommodel::where('visitercheckinid',$request->visitercheckinid) ->where('roomid',$request->roomid);
            // $data1->delete();
            $Allocateroommodel = new Allocateroommodel;
            $Allocateroommodel->visitercheckinid = $request->visitercheckinid;
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
          $Allocateroommodel = new Allocateroommodel;
          $Allocateroommodel->visitercheckinid = $request->visitercheckinid;
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
public function destroy($id,$vistername)
{
   DB::update('update room_master set status = ? where id = ?',[1,$id]);
    return DB::table('allocateroom')->where('roomid',$id)->where('visterid',$vistername)->delete();
}
public function getvisallocateroom($visterid,$id){

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
            ->where('allocateroom.visterid', '=', $visterid)
            ->where('allocateroom.visitercheckinid', '=', $id)
            //->where('allocateroom.status', '=',1)
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
public function getvistercheckoutentry($rid,$visterid){
  
   // echo "rid".$rid."visterid".$visterid;
       $result= DB::update('update allocateroom set status = ? where roomid = ? And visterid = ? And status= ?',[0,$rid,$visterid,1]);
        DB::update('update room_master set status = ? where id = ?',[1,$rid]);
       
        return response()->json($result);
    
}
public function deleteallocateroom($id){
  
  $data=DB::table('allocateroom')->where('visitercheckinid',$id)->get();
  foreach($data as $getrom){
    $roomid=$getrom->roomid;
    DB::update('update room_master set status = ? where id = ?',[1,$roomid]);
  }
  return DB::table('allocateroom')->where('visitercheckinid',$id)->delete();
}
}
