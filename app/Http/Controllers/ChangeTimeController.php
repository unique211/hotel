<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Changetimemodel;
use Session;
use Illuminate\Support\Facades\DB;
class ChangeTimeController extends Controller
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
            return view('changetime');
        }
    }
    public function store(Request $request){

        $data= DB::table('changetime')->get();
        $count=count($data);
        if($count >0){
            foreach($data as $changetimedata){
                 $id=$changetimedata->id;
           $update=DB::update('update changetime set chanegtimeing = ? ,currency = ? where id = ?',[$request->changetimeing,$request->changecurrencyinfo,$id]);
               
           if($update){
            $request->session()->forget('savetime');
            $request->session()->forget('savecurrency');
           
                Session::put('savetime',$request->changetimeing);
                Session::put('savecurrency',$request->changecurrencyinfo);
                $result[]=array(
                    'changetimeing'=>$request->changetimeing,
                    'changecurrencyinfo'=>$request->changecurrencyinfo,
                );
                return $result;
            }
            }
       
        }else{

        $Changetimemodel = new Changetimemodel;
        $Changetimemodel->chanegtimeing = $request->changetimeing; 
        $Changetimemodel->currency = $request->changecurrencyinfo; 
       $data= $Changetimemodel->save();
        if ($data){
            Session::put('savetime',$request->changetimeing);
            Session::put('savecurrency',$request->changecurrencyinfo);
            $result[]=array(
                'changetimeing'=>$request->changetimeing,
                'changecurrencyinfo'=>$request->changecurrencyinfo,
            );
            return $result;
        }
    }
      
       
    }
    public function update(Request $request)
    {
      

      
       
       
    }

}
