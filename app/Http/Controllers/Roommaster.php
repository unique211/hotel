<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Roommastermodel;
class Roommaster extends Controller
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
            return view('roommaster');
        }
       
       
    }
    public function store(Request $request){
       
        $data = DB::table('room_master')
        ->where('room_master.roomno',$request->roomno)
        ->get();
        if($data->count() >0){
            return response()->json('100'); 
        }else{
        $Roommastermodel = new Roommastermodel;
        $Roommastermodel->roomno = $request->roomno;
        $Roommastermodel->roomname = $request->name;
        $Roommastermodel->categoryid = $request->category;
        $Roommastermodel->description = $request->description;
      
        if ($Roommastermodel->save()) {
            return $Roommastermodel->id;
        
        }
    }

        //Employee::create($form_data);
      //  return Response::json(array('success' => true, 'last_insert_id' => $data->id), 200);
        //return response()->json(['success' => 'Data Added successfully.']);
     
    
}
    public function getallroomdata(){
        $data = DB::table('room_master')
            ->join('categorys', 'categorys.id', '=', 'room_master.categoryid')
            ->select('room_master.*', 'categorys.name as categoryname')
            ->orderBy('room_master.id','Desc')
            ->get();

            return response()->json($data); 
    }
    public function update(Request $request)
{
    $data = DB::table('room_master')
    ->where('room_master.roomno',$request->roomno)
    ->where('room_master.id','!=',$request->saveid)
    ->get();
    if($data->count() >0){
        return response()->json('100'); 
    }else{
    
    $form_data = array(
        'roomno'        =>  $request->roomno,
        'roomname'         =>  $request->name,
        'categoryid'        =>  $request->category,
        'description'        =>  $request->description,
  
    );

  $id=  Roommastermodel::whereId($request->saveid)->update($form_data);
 return response()->json($id);
}
}
public function destroy($id)
{
    $roominfo = DB::table('room_master')->where('id',$id)->where('status','2')->get();
    $count=count($roominfo);
    if($count==0){
        $data = Roommastermodel::findOrFail($id);
        $data->delete();
        return response()->json($data); 
    }else{
        return response()->json('100'); 
    }
    
}
public function avalibleroomdata($id){
   
    // $data = DB::table('room_master')
    // ->join('categorys', 'categorys.id', '=', 'room_master.categoryid')
    // ->select('room_master.*', 'categorys.name as categoryname,categorys.rate,categorys.capacity')
    // ->where('room_master.status', '=', 1)
    // ->get();

    // return response()->json($data); 
}
public function checkexistroomno($roomno){
   
 
    $data = DB::table('room_master')
    ->where('room_master.roomno',$roomno)
    ->get();
    if($data->count() >0){
        return response()->json('100'); 
    }else{
        return response()->json('0'); 
    }
    
}
public function checkeditexistroomno($roomno,$id){
    $data = DB::table('room_master')
    ->where('room_master.roomno',$roomno)
    ->where('room_master.id','!=',$id)
    ->get();
    if($data->count() >0){
        return response()->json('100'); 
    }else{
        return response()->json('0'); 
    }
}
public function checkeditexistroomname($roomname,$id){
    $data = DB::table('room_master')
    ->where('room_master.roomname',$roomname)
    ->where('room_master.id','!=',$id)
    ->get();
    if($data->count() >0){
        return response()->json('100'); 
    }else{
        return response()->json('0'); 
    }
}
public function checkexistroomname($roomname){
   
 
    $data = DB::table('room_master')
    ->where('room_master.roomname',$roomname)
    ->get();
    if($data->count() >0){
        return response()->json('100'); 
    }else{
        return response()->json('0'); 
    }
    
}



}
