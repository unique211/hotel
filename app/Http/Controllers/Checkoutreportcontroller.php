<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Checkoutreportcontroller extends Controller
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
            } else{
                return view('checkoutreport');
            }
            
           
        }
        public function getcheckoutvisitor($formdate,$todate){
            $result=array();
            $data = DB::table('vistercheckout_master')->whereDate('checkouttime', '>=',$formdate)->whereDate('checkouttime', '<=',$todate)->get();
            foreach($data as $cheindata){
                $date=$cheindata->checkouttime;
                $visiterid=$cheindata->visterid;
                $vistername="";
                $id=$cheindata->id;
                $data1 = DB::table('visiter_master')->where('id',$visiterid)->get();
                foreach($data1 as $visterdata){
                    $vistername=$visterdata->visitername;
                }
                $result[]=array(
                    'date'=>$date,
                    'visiterid'=>$visiterid,
                    'visitername'=>$vistername,
                    'id'=>$id,
                );
            }
            return response()->json($result);
        }

}
