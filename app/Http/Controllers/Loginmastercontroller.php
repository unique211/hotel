<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Response;
use Illuminate\Support\Facades\DB;
class Loginmastercontroller extends Controller
{
    //
    public function checklogin(Request $request){

        $userid = $request->username;
        $password = $request->password;
    
    
      // echo ($userid."".$password);
    
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
                $changet='';
                $userdata = DB::table('user_management')->where('id',$uid)->get();
                foreach($userdata as $usermanage){
                    $username=$usermanage->username;
                    $mobileno=$usermanage->mobileno;
        
                   
                }
                Session::put('username',$username);
                Session::put('userid',$uid);
                Session::put('mobileno',$mobileno);
                Session::put('role',$role);
    

                $data2 = DB::table('changetime')->orderBy('id', 'DESC')->first();
                foreach($data2 as $changetimedata){
                    $changet=$changetimedata->chanegtime;
                   
                }
                if($changet !=""){
                    Session::put('savetime',$changet);
                }
                //return view('dashboard');
                return  response()->json(1);


            }
        }else{
            return  response()->json(0);
        }
      
        
        
    }

}
