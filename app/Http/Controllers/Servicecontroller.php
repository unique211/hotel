<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicemodel;
use Illuminate\Support\Facades\DB;
use App\Requests;
use Session;
use Response;
use Redirect;

class Servicecontroller extends Controller
{

    public function __construct()
    {
        $this->middleware('usersession');
    }
    public function index(){
        return view('extraservice');
    }
    public function store(Request $request)
    {
        $ID = $request->saveid;
           // dd('hii');

           if($ID==""){
            $catdata = DB::table('extra_service')->where('servicename',$request->servicename)->get();
            $count=count($catdata);
            if($count >0 ){
               return '100';
            }else{
            $service   =   Servicemodel::updateOrCreate(
                ['id' => $ID],
                [
                    'servicename'       =>   $request->servicename,
                    'unit'        =>   $request->unit,
                    'rate'        =>   $request->rate,

                ]
        );
        return Response::json($service);
                }
           }else{
            $catdata = DB::table('extra_service')->where('servicename',$request->servicename)->where('id','!=',$ID)->get();
            $count=count($catdata);
            if($count >0 ){
               return '100';
            }else{

                $service   =   Servicemodel::updateOrCreate(
                    ['id' => $ID],
                    [
                        'servicename'       =>   $request->servicename,
                        'unit'        =>   $request->unit,
                        'rate'        =>   $request->rate,

                    ]
            );
            return Response::json($service);
            }
           }



    }
    public function getallservice(){
        $data = DB::table('extra_service')->get();


        return Response::json($data);
    }
    public function destroy($id)
    {
        $data = Servicemodel::findOrFail($id);
        $data->delete();


    }
}
