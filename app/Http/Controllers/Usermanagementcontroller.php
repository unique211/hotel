<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Usermanagementmodel;
use App\Loginmastermodel;
use App\Requests;
use Session;
use Response;
use Redirect;
class Usermanagementcontroller extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('usersession');
    }
    public function index(){
        return view('usermanagement');
    }
    public function store(Request $request)
    {
        $ID = $request->saveid;


        if($ID >0){
            $data = DB::table('user_management')->where('mobileno',$request->mobileno)->where('id','!=',$ID)->get();
            $count=$data->count();
            if($count >0){
                return '100';
            }else{

                $data = DB::table('login_master')->where('userid',$request->user_id)->where('uid','!=',$ID)->get();
                $count=$data->count();
                if($count >0){
                    return '101';
                }else{

                $customer   =   Usermanagementmodel::updateOrCreate(
                    ['id' => $ID],
                    [
                        'username'       =>   $request->username,
                        'email'        =>   $request->email,
                        'mobileno'        =>   $request->mobileno,
                        'role'        =>   $request->user_type,
                       
        
                    ]
        
                );
                $ref_id = $customer->id;
                $customer2   =   Loginmastermodel::updateOrCreate(
                    ['uid' => $ref_id],
                    [
        
                        'role'        =>   $request->user_type,
                        'userid'        =>   $request->user_id,
                        'password'        =>   $request->password,
        
                    ]
        
                );
                //   return $customer->id;
        
                //   dd($dob);
                return Response::json($customer);
            }
            }
        }else{

            $data = DB::table('user_management')->where('mobileno',$request->mobileno)->get();
            $count=$data->count();
            if($count >0){
                return '100';
            }else{

                $data = DB::table('login_master')->where('userid',$request->user_id)->get();
                $count=$data->count();
                if($count >0){
                    return '101';
                }else{
                    $customer   =   Usermanagementmodel::updateOrCreate(
                        ['id' => $ID],
                        [
                            'username'       =>   $request->username,
                            'email'        =>   $request->email,
                            'mobileno'        =>   $request->mobileno,
                            'role'        =>   $request->user_type,
                           
            
                        ]
            
                    );
                    $ref_id = $customer->id;
                    $customer2   =   Loginmastermodel::updateOrCreate(
                        ['uid' => $ref_id],
                        [
            
                            'role'        =>   $request->user_type,
                            'userid'        =>   $request->user_id,
                            'password'        =>   $request->password,
            
                        ]
            
                    );
                    //   return $customer->id;
            
                    //   dd($dob);
                    return Response::json($customer);//last changes
                }

                
            }
           
        }
        
      
    }
    public function alluser(){
        $data = DB::table('user_management')
        //   ->join('Checkin_master', 'Checkin_master.visiterid', '=', 'allocateroom.visterid')
           ->join('login_master', 'login_master.uid', '=', 'user_management.id')
            ->select('user_management.*', 'login_master.*','user_management.id','user_management.role')
           ->get();

           return Response::json($data);
    }
    public function checkuserid($userid){
        $data = DB::table('login_master')->where('userid',$userid)->get();
        $count=$data->count();

        return Response::json($count);


    }
    public function destroy($id)
{
    $data = Usermanagementmodel::findOrFail($id);
    $data->delete();

    $data1 = Loginmastermodel::where('uid',$id);
        $data1->delete();
    return response()->json($data); 
}
public function checklogin($userid,$password){

   // $userid = $request->username;
  //  $password = $request->password;


   // dd($userid."".$password);

    $data = DB::table('login_master')->where('userid',$userid)->where('password',$password)->get();
    $count=$data->count();
    if($count >0){
        foreach($data as $data1){
            $uid= $data1->uid;
            $userid= $data1->userid;
            $role= $data1->role;
            $password= $data1->password;
            $username='';
            $mobileno='';
    
            $userdata = DB::table('user_management')->where('id',$uid)->get();
            foreach($userdata as $usermanage){
                $username=$usermanage->username;
                $mobileno=$usermanage->mobileno;
    
               
            }
            Session::put('username',$username);
            Session::put('userid',$uid);
            Session::put('mobileno',$mobileno);
            Session::put('role',$role);

            //return view('dashboard');
            return  response()->json(1);
        }
    }else{
        return  response()->json(0);
    }
  
    
    
}
public function checkusermobile($mobile){
    $data= DB::table('user_management')->where('mobileno',$mobile)->get();
  $count=count($data);
  
  return response()->json($count);
}
public function editcheckusermobile($mobile,$id){
    $data= DB::table('user_management')->where('mobileno',$mobile)->where('id',$id)->get();
    $count=count($data);
    
    return response()->json($count);
}
public function checkexistemail($email){
    $data= DB::table('user_management')->where('email',$email)->get();
  $count=count($data);
  
  return response()->json($count);
}
public function editcheckexistemail($email,$id){
    $data= DB::table('user_management')->where('email',$email)->where('id',$id)->get();
    $count=count($data);
    
    return response()->json($count);
}

}
