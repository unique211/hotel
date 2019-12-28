<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DatePeriod;
use DateInterval;
use Illuminate\Support\Facades\DB;
class Invoicereportcontroller extends Controller
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
                return view('invoicereport');
            }
            
           
        }
        public function getinvoicedata($formdate,$todate,$visitor){
            $result=array();
            $alldate=array();
           // dd($visitor);
          
                $array = array();
                $interval = new DateInterval('P1D');
            
                $realEnd = new DateTime($todate);
                $realEnd->add($interval);
                $format = 'Y-m-d';
                $period = new DatePeriod(new DateTime($formdate), $interval, $realEnd);
            
                foreach($period as $date) { 
                    $array[] = $date->format($format); ;
                }
                    if($visitor =="All"){
                foreach($array as $array1) { 
                    $extarservice = DB::table('visiter_master')
                    ->get();
                    foreach($extarservice as $data){
                        $visiterid=$data->id;
                        $visitername=$data->visitername;
                        $amt=0;
                        $date="";
                        $data1 = DB::table('invoice_master')->where('invoicedate',$array1)->where('visiterid',$visiterid)->get();
                        foreach($data1 as $data2){
                            $date=$data2->invoicedate;
                            $totalamt=$data2->totalamt;
                            $amt=$amt+$totalamt;

                        }
                        if($amt >0 ){
                            $result[]=array(
                                'date'=>$date,
                                'amt'=>$amt,
                                'visiterid'=>$visiterid,
                                'visitername'=>$visitername,
                            );
                        }
                        
                    }

                }
            }else{
                foreach($array as $array1) { 
                    $extarservice = DB::table('visiter_master')
                    ->where('visiter_master.id',$visitor)
                    ->get();
                    foreach($extarservice as $data){
                        $visiterid=$data->id;
                        $visitername=$data->visitername;
                        $amt=0;
                        $date="";
                        $data1 = DB::table('invoice_master')->where('invoicedate',$array1)->where('visiterid',$visiterid)->get();
                        foreach($data1 as $data2){
                            $date=$data2->invoicedate;
                            $totalamt=$data2->totalamt;
                            $amt=$amt+$totalamt;

                        }
                        if($amt >0 ){
                            $result[]=array(
                                'date'=>$date,
                                'amt'=>$amt,
                                'visiterid'=>$visiterid,
                                'visitername'=>$visitername,
                            );
                        }
                        
                    }

                }
            }
               
            
            
          
            return response()->json($result);
        }
        public function getallvisitor(){
            $data1 = DB::table('visiter_master')->get();
            return response()->json($data1);

        }
}
