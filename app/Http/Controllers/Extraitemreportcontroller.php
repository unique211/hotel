<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DateTime;
use DatePeriod;
use DateInterval;

class Extraitemreportcontroller extends Controller
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
                return view('extraservicereport');
            }
            
           
        }

        public function getextraitemdata($formdate,$todate){
         
            $result=array();
            $alldate=array();
          
                $array = array();
                $interval = new DateInterval('P1D');
            
                $realEnd = new DateTime($todate);
                $realEnd->add($interval);
                $format = 'Y-m-d';
                $period = new DatePeriod(new DateTime($formdate), $interval, $realEnd);
            
                foreach($period as $date) { 
                    $array[] = $date->format($format); ;
                }
            
                foreach($array as $array1) { 
                    $extarservice = DB::table('extra_service')
                    ->get();
                    foreach($extarservice as $data){
                        $serviceid=$data->id;
                        $servicename=$data->servicename;
                        $sum=0;
                        $date="";
                        $data1 = DB::table('allocate_servicedetalis')->whereDate('datetime',$array1)->where('serviceid',$serviceid)->get();
                        foreach($data1 as $data2){
                            $date=$data2->datetime;
                            $qty=$data2->qty;
                            $sum=$sum+$qty;

                        }
                        if($sum >0 ){
                            $result[]=array(
                                'date'=>$date,
                                'qty'=>$sum,
                                'serviceid'=>$serviceid,
                                'servicename'=>$servicename,
                            );
                        }
                        
                    }

                }
               
            
            
          
            return response()->json($result);
        }
}
