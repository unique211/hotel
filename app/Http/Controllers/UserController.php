<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Login_master;
use App\User_master;
use Redirect, Response;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data['customer'] = Customer_master::orderBy('id', 'asc')->paginate(8);
        if (!$request->session()->exists('userid')) {
            // user value cannot be found in session
            return redirect('/');
        } else {
            return view('user_manage');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ID = $request->save_update;
        $user_id = $request->session()->get('userid');
        // $date1 = strtr($request->birth_date, '/', '-');
        // $dob = date('Y-m-d', strtotime($date1)); //should be course_date
        $customer   =   User_master::updateOrCreate(
            ['id' => $ID],
            [
                'username'       =>   $request->name,
                'mobileno'        =>   $request->mobile,
                'email'        =>   $request->email,
                'role'        =>   $request->role,
                
               
            ]

        );

        $exp_date = date('Y-m-d', strtotime('+5 years')); //should be course_date
        $ref_id = $customer->id;
        $customer2   =   Login_master::updateOrCreate(
            ['ref_id' => $ref_id],
            [

                'role'        =>   $request->role,
                'user_id'        =>   $request->userid,
                'password'        =>   $request->password,
               
            ]

        );
        //   return $customer->id;


        //   dd($dob);
        return Response::json($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $customer  = User_master::where($where)->first();

        return Response::json($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $customer = User_master::where('id', $id)->delete();
        $customer2 = Login_master::where('ref_id', $id)->delete();


        return Response::json($customer);
    }

    public function get_users()
    {
        $data = DB::table('user_management')
            ->select('user_management.*')
            ->get();
        //   ->join('customer_master', 'customer_master.id', '=', 'customers.name')


        // $data = Customer_master::orderBy('id', 'asc')->get();
        return Response::json($data);
    }
    public function chk_email($id)
    {
        $where = array('email' => $id);
        $user  = User_master::where($where)->get();
        $cnt = count($user);
        return Response::json($cnt);
    }
    public function chk_userid($id)
    {
        $where = array('user_id' => $id);
        $user  = Login_master::where($where)->get();
        $cnt = count($user);
        return Response::json($cnt);
    }
    public function check_login(Request $request)
    {
        $user_id = $request->user_id;
        $password = $request->password;


        $msg = 0;
        $user = DB::table('login_master')
            ->select('login_master.*')
            ->where('userid', $user_id)
            ->where('password', $password)
            ->get();

        $cnt = count($user);



        if ($cnt > 0) {
            $get_password = "";
            $get_user_id = "";
            $get_role = "";
            $get_id = "";


            foreach ($user as $user1) {
                $get_password =  $user1->password;
                $get_user_id =  $user1->userid;
                $get_role =  $user1->role;
                $get_id =  $user1->id;
            }


            if (($get_user_id == $user_id) && ($get_password == $password)) {



                if ($get_role == "User" || $get_role == "Manager" || $get_role=="Admin") {
                    $changet='';
                    $changecurrecy='';
                    $data2 = DB::table('changetime')->orderBy('id', 'DESC')->first();
                   
                   
                    if($data2 !=null){
                        $changet=$data2->chanegtimeing;
                        $changecurrecy=$data2->currency;
                       
                        if($changet !=""){
                           
                            $request->session()->put('savetime',  $changet);
                            
                        }
                        if($changecurrecy !=""){
                            $request->session()->put('savecurrency', $changecurrecy );
                        }
                    }
                
                 
                    
                    $exp = DB::table('login_master')
                    ->select('login_master.*')
                    ->where('userid', $user_id)
                    ->where('password', $password)
                    ->get();
                    $cnt1 = count($exp);

                    if ($cnt1 > 0) {
                        $msg = 1;
                        $request->session()->put('userid',  $user_id);
                        $request->session()->put('role',  $get_role);
                        $request->session()->put('id',  $get_id);

                       

                        
                    } else {
                        $msg = 2;
                    }
                } 
            }
        }

        return $msg;
        //   return Response::json($msg);
    }
}