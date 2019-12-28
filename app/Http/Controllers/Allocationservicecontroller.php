<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Allocationservicemodel;
use App\Allocateservicedetalismodel;
class Allocationservicecontroller extends Controller
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
            return view('allocateservice');
        }
       
    }
    public function allallocateroom(){
        $result=array();
        $roomdata = DB::table('room_master')->join('categorys', 'categorys.id', '=', 'room_master.categoryid')->where('room_master.status','2')->select('room_master.*', 'categorys.name as catergory','categorys.rate')->get();
        foreach($roomdata as $data){
            $id1= $data->id;
            $categoryid= $data->categoryid;
            $categoryname= $data->catergory;
            $rate= $data->rate;
            $roomname= $data->roomname;
            $roomno=$data->roomno;
            $visterid='';
            $vistername='';
          

            $allocatedata= DB::table('allocateroom') ->where('roomid', '=',$id1)->where('status', '=',1)->get();
            if($allocatedata->count()>0){
               foreach($allocatedata as $allocatedata1){
                $visterid=$allocatedata1->visterid;
               }
            }
            if($visterid >0){
                $visterdata= DB::table('visiter_master') ->where('id', '=',$visterid)->get();
                foreach($visterdata as $getvister){
                    $vistername=$getvister->visitername;
                }
            }
            $result[]=array(
                'categoryid'=>$categoryid,
                'categoryname'=>$categoryname,
                'visterid'=>$visterid,
                'rate'=>$rate,
                'roomno'=> $roomno,
                'roomid'=> $id1,
               );


        }
        return response()->json($result);  
    }
    public function getallservice(){
      
        $services = DB::table('extra_service')->get();
        return response()->json($services); 
    }
    public function getservicerate($id){
        $services = DB::table('extra_service')->where('id',$id)->get();
        return response()->json($services); 
    }
    public function store(Request $request){

       
        $Allocationservicemodel = new Allocationservicemodel;
        $Allocationservicemodel->roomid = $request->allocaterom;
        $Allocationservicemodel->visterid = $request->visiterid;
       if ($Allocationservicemodel->save()) {
            return $Allocationservicemodel->id;
        
        }
    }
    public function getroomvisterinfo($rooid){
       

        $allocatedata= DB::table('allocateroom') ->where('roomid', '=',$rooid)->where('status', '=',1)->get();
            if($allocatedata->count()>0){
               foreach($allocatedata as $allocatedata1){
                $visterid=$allocatedata1->visterid;
               }
            }
            if($visterid >0){
                $visterdata= DB::table('visiter_master') ->where('id', '=',$visterid)->get();
                return response()->json($visterdata); 
            }
    }
    public function getroomwiseservice(){
        $allocateservice= DB::table('allocate_service')
        ->join('room_master', 'room_master.id', '=', 'allocate_service.roomid')
        ->where('allocate_service.status',1)
         ->select('allocate_service.*', 'room_master.roomno')
        ->get();
        return response()->json($allocateservice);

    }
    public function update(Request $request)
{
    
    $form_data = array(
        'roomid'        =>  $request->allocaterom,
        'visterid'    =>  $request->visiterid,
        
  
    );
   
    
  $id=  Allocationservicemodel::whereId($request->saveid)->update($form_data);



    return response()->json($id);
}
public function destroy($id)
{
  $data = Allocateservicedetalismodel::where('allocate_sid', $id);
  $data->delete();

  $data1 = Allocationservicemodel::where('id', $id);
  $data1->delete();
 
  return response()->json($data1);
}
}
