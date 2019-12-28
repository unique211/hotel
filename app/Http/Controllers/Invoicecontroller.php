<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Response;
use Redirect;

use App\Invoicemodel;
use App\Invoicedetailsmodel;
class Invoicecontroller extends Controller
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
            return view('invoice');
        }
        
       
    }
    public function searchroomdata($roomno,$visterid){
        $result=array();
        $data = DB::table('room_master')
        ->join('categorys', 'categorys.id', '=', 'room_master.categoryid')
        ->select('room_master.*', 'categorys.*','room_master.id as id')
        ->where('roomno',$roomno)->get();
        foreach($data as $roomdata){
            $roomno1=$roomdata->roomno;
            $roomid=$roomdata->id;
            $categoryid=$roomdata->categoryid;
            $categoryname=$roomdata->name;
            $roomrate=$roomdata->rate;
            $checkoutid='';
            $data1 = DB::table('allocateroom')->where('roomid',$roomid)->where('visterid',$visterid)->where('checkoutid','>',0)->where('invoiceid','=',null)->orderBy('id', 'desc')->get();
            foreach($data1 as $allocatedata){
                $visterid=$allocatedata->visterid;
               
                $checkoutid=$allocatedata->checkoutid;
                $checkintime='';
                $checkouttime='';
                $visitername='';

                if($checkoutid > 0){
                    $data2 = DB::table('vistercheckout_master')->where('id',$checkoutid)->orderBy('id', 'desc')->get(); 
                    foreach($data2 as $visterdata){
                        $checkintime=$visterdata->checkintime;
                        $checkouttime=$visterdata->checkouttime;
                        $visitername=$visterdata->visternam;
                    }
                 }
                 $date1 = strtotime($checkintime);  
                $date2 = strtotime($checkouttime); 

                $diff = abs($date2 - $date1);  
  
                $years = floor($diff / (365*60*60*24));  
                 $months = floor(($diff - $years * 365*60*60*24) 
                                               / (30*60*60*24));  
                $days = floor(($diff - $years * 365*60*60*24 -  
                             $months*30*60*60*24)/ (60*60*24)); 
                  
               


            }
            $result[]=array(
                'roomno'=>$roomno1,
                'roomid'=>$roomid,
                'categoryid'=>$categoryid,
                'checkoutid'=>$checkoutid,
                'checkintime'=>$checkintime,
                'checkouttime'=>$checkouttime,
                'visitername'=>$visitername,
                'visterid'=>$visterid,
                'days'=>$days,
                'roomrate'=>$roomrate,
                'categoryname'=>$categoryname,
            );



        }

           return Response::json($result);

    }
    public function getdropdown(){
        $data = DB::table('visiter_master')->get();
        return Response::json($data);
    }
    public function store(Request $request){
       
        
        $catdata = DB::table('invoice_master')->where('invoiceno',$request->invoiceno)->get();
        $count=count($catdata);
        if($count >0 ){
           return '0';
        }else{

        
        $date = str_replace('/', '-', $request->date );
        $Invoicemodel = new Invoicemodel;
        $Invoicemodel->invoiceno = $request->invoiceno;
        $Invoicemodel->invoicedate = date("Y-m-d", strtotime($date));
        $Invoicemodel->totalamt =$request->totalamt;
        $Invoicemodel->visiterid = $request->vistername;
        $Invoicemodel->checkout_roomno = $request->roomno;
        $Invoicemodel->paidamt = $request->paidamt;
        $Invoicemodel->paymentmode = $request->amtmode;
        $Invoicemodel->remark = $request->remark;
       
      
        if ($Invoicemodel->save()) {
            return $Invoicemodel->id;
        
        }
    }
 
}
public function getallinvicedata(){
    $data = DB::table('invoice_master')
    ->join('visiter_master', 'visiter_master.id', '=', 'invoice_master.visiterid')
    ->select('invoice_master.*', 'visiter_master.visitername','invoice_master.id as id')
    ->get();
    return Response::json($data);
}
public function update(Request $request)
{
    $catdata = DB::table('invoice_master')->where('invoiceno',$request->invoiceno)->where('id','!=',$request->saveid)->get();
    $count=count($catdata);
    if($count >0 ){
       return '0';
    }else{

    $data = Invoicedetailsmodel::where('invoiceid',$request->saveid);
    $data->delete();
    $date = str_replace('/', '-', $request->date );
   

    $form_data = array(
        'invoiceno'        =>  $request->invoiceno,
        'invoicedate'    =>  date("Y-m-d", strtotime($date)),
        'checkout_roomno'        =>  $request->roomno,
        'visiterid'        =>  $request->vistername,
        'paidamt'        =>  $request->paidamt,
        'paymentmode'        =>  $request->amtmode,
        'remark'        =>  $request->remark,
      
        
  
    );
   
    
  $id=  Invoicemodel::whereId($request->saveid)->update($form_data);
    return response()->json($id);
}
}
public function searcheditroomdata($roomno,$visterid){
    $result=array();
        $data = DB::table('room_master')
        ->join('categorys', 'categorys.id', '=', 'room_master.categoryid')
        ->select('room_master.*', 'categorys.*','room_master.id as id')
        ->where('roomno',$roomno)->get();
        foreach($data as $roomdata){
            $roomno1=$roomdata->roomno;
            $roomid=$roomdata->id;
            $categoryid=$roomdata->categoryid;
            $categoryname=$roomdata->name;
            $roomrate=$roomdata->rate;

            $data1 = DB::table('allocateroom')->where('roomid',$roomid)->where('visterid',$visterid)->where('checkoutid','>',0)->whereNull('invoiceid')->orderBy('id', 'desc')->get();
            foreach($data1 as $allocatedata){
                $visterid=$allocatedata->visterid;
               
                $checkoutid=$allocatedata->checkoutid;
                $checkintime='';
                $checkouttime='';
                $visitername='';

                if($checkoutid > 0){
                    $data2 = DB::table('vistercheckout_master')->where('id',$checkoutid)->orderBy('id', 'desc')->get(); 
                    foreach($data2 as $visterdata){
                        $checkintime=$visterdata->checkintime;
                        $checkouttime=$visterdata->checkouttime;
                        $visitername=$visterdata->visternam;
                    }
                 }
                 $date1 = strtotime($checkintime);  
                $date2 = strtotime($checkouttime); 

                $diff = abs($date2 - $date1);  
  
                $years = floor($diff / (365*60*60*24));  
                 $months = floor(($diff - $years * 365*60*60*24) 
                                               / (30*60*60*24));  
                $days = floor(($diff - $years * 365*60*60*24 -  
                             $months*30*60*60*24)/ (60*60*24)); 


                  
               


            }
            $result[]=array(
                'roomno'=>$roomno1,
                'roomid'=>$roomid,
                'categoryid'=>$categoryid,
                'checkoutid'=>$checkoutid,
                'checkintime'=>$checkintime,
                'checkouttime'=>$checkouttime,
                'visitername'=>$visitername,
                'visterid'=>$visterid,
                'days'=>$days,
                'roomrate'=>$roomrate,
                'categoryname'=>$categoryname,
            );



        }

           return Response::json($result);

}
public function destroy($id)
    {
        DB::update('update allocateroom set invoiceid = ? where invoiceid = ?',[null,$id]);
        $data = Invoicedetailsmodel::where('invoiceid',$id);
        $data->delete();

        $data = Invoicemodel::where('id',$id);
        $data->delete();
       
    }
    public function getallbookedinfo($visterid){
        $result=array();
        $data1 = DB::table('allocateroom')->where('visterid',$visterid)->where('checkoutid','>',0)->whereNull('invoiceid')->orderBy('id', 'desc')->get();
        foreach($data1 as $allocatedata){
            $visterid=$allocatedata->visterid;
            $roomid=$allocatedata->roomid;
            $checkoutid=$allocatedata->checkoutid;
            $checkintime='';
            $checkouttime='';
            $visitername='';
            $roomno=0;
            $roomrate=0;
            $categoryid='';
            $categoryname='';
            $extraserviceamt=0;
            if($roomid >0){
               
                $data2 = DB::table('allocate_service')->where('visterid',$visterid)->where('roomid',$roomid)->get();
                foreach($data2 as $allocatedata){
                    $alocateid=$allocatedata->id;
                   
                    $data3 = DB::table('allocate_servicedetalis')->where('allocate_sid',$alocateid)->get();
                    foreach($data3 as $allocationdata){
                            $sum=0;
                            $rate=$allocationdata->rate;  
                            $qty=$allocationdata->qty;  
                            if($rate > 0 && $qty > 0){
                                $sum=$rate * $qty;
                            }else{
                                $sum=0;
                            }  
                            $extraserviceamt=$sum+$extraserviceamt; 
                    }
                }
            }
           


            if($roomid >0){
                $roomdata = DB::table('room_master')
                ->join('categorys', 'categorys.id', '=', 'room_master.categoryid')
                ->select('room_master.*', 'categorys.*','room_master.id as id')
                ->where('room_master.id',$roomid)->get();
                foreach($roomdata as $roomifo){
                    $roomno=$roomifo->roomno;
                    $roomrate=$roomifo->rate;
                    $categoryid=$roomifo->categoryid;
                    $categoryname=$roomifo->name;
                }
            
            }

            if($checkoutid > 0){
                $data2 = DB::table('vistercheckout_master')->where('id',$checkoutid)->orderBy('id', 'desc')->get(); 
                foreach($data2 as $visterdata){
                    $checkintime=$visterdata->checkintime;
                    $checkouttime=$visterdata->checkouttime;
                    $visitername=$visterdata->visternam;
                }
             }
             $date1 = strtotime($checkintime);  
            $date2 = strtotime($checkouttime); 

            $diff = abs($date2 - $date1);  

            $years = floor($diff / (365*60*60*24));  
             $months = floor(($diff - $years * 365*60*60*24) 
                                           / (30*60*60*24));  
            $days = floor(($diff - $years * 365*60*60*24 -  
                         $months*30*60*60*24)/ (60*60*24)); 
              
           
                         $result[]=array(
                            'roomno'=>$roomno,
                            'roomid'=>$roomid,
                            'categoryid'=>$categoryid,
                            'checkoutid'=>$checkoutid,
                            'checkintime'=>$checkintime,
                            'checkouttime'=>$checkouttime,
                            'visitername'=>$visitername,
                            'visterid'=>$visterid,
                            'days'=>$days,
                            'roomrate'=>$roomrate,
                            'categoryname'=>$categoryname,
                            'extraserviceamt'=>$extraserviceamt,
                        );

        }
        return $result;
    }
    public function getroomwiseservicelist($visterid){
       $result=array();
     
        $data1 = DB::table('allocateroom')->where('visterid',$visterid)->where('checkoutid','>',0)->whereNull('invoiceid')->orderBy('id', 'desc')->get();
        foreach($data1 as $allocatedata){
            $visterid=$allocatedata->visterid;
            $roomid=$allocatedata->roomid;
            $roomno="";
            if($roomid >0){
                $data5 = DB::table('room_master')->where('id',$roomid)->get();
                foreach($data5 as $roomdata){
                   $roomno= $roomdata->roomno;
                }

               
                $data2 = DB::table('allocate_service')->where('visterid',$visterid)->where('roomid',$roomid)->get();
                foreach($data2 as $allocatedata){
                    $alocateid=$allocatedata->id;
                   
                    
                    $data3 = DB::table('allocate_servicedetalis')
                    ->join('extra_service', 'extra_service.id', '=', 'allocate_servicedetalis.serviceid')
                    ->select('allocate_servicedetalis.*', 'extra_service.servicename')
                    ->where('allocate_sid',$alocateid)->get();

                    foreach($data3 as $getservicedetalis){
                            $sum=0;
                            $rate=$getservicedetalis->rate;  
                            $qty=$getservicedetalis->qty; 
                            $servicename1=$getservicedetalis->servicename; 
                            $serviceid=$getservicedetalis->serviceid; 
                            $datetime=$getservicedetalis->datetime;
                            if($rate > 0 && $qty > 0){
                                $sum=$rate * $qty;
                            }
                            $result[]=array(
                                'rate'=>$rate,
                                'qty'=>$qty,
                                'servicename'=>$servicename1,
                                'serviceid'=>$serviceid,
                                'sum'=>$sum,
                                'datetimedata'=>$datetime,
                                'roomno'=>$roomno,
                            );
                    }
                }
            }
          

        }
        return $result;
    }
    public function geteditvisitorinvoice($id){
        $result=array();
        $data1 = DB::table('allocateroom')->where('invoiceid',$id)->orderBy('id', 'desc')->get();
        foreach($data1 as $allocatedata){
            $visterid=$allocatedata->visterid;
            $roomid=$allocatedata->roomid;
            $checkoutid=$allocatedata->checkoutid;
            $checkintime='';
            $checkouttime='';
            $visitername='';
            $roomno=0;
            $roomrate=0;
            $categoryid='';
            $categoryname='';
            $extraserviceamt=0;
            if($roomid >0){
               
                $data2 = DB::table('allocate_service')->where('visterid',$visterid)->where('roomid',$roomid)->get();
                foreach($data2 as $allocatedata){
                    $alocateid=$allocatedata->id;
                   
                    $data3 = DB::table('allocate_servicedetalis')->where('allocate_sid',$alocateid)->get();
                    foreach($data3 as $allocationdata){
                            $sum=0;
                            $rate=$allocationdata->rate;  
                            $qty=$allocationdata->qty;  
                            if($rate > 0 && $qty > 0){
                                $sum=$rate * $qty;
                            }else{
                                $sum=0;
                            }  
                            $extraserviceamt=$sum+$extraserviceamt; 
                    }
                }
            }
           


            if($roomid >0){
                $roomdata = DB::table('room_master')
                ->join('categorys', 'categorys.id', '=', 'room_master.categoryid')
                ->select('room_master.*', 'categorys.*','room_master.id as id')
                ->where('room_master.id',$roomid)->get();
                foreach($roomdata as $roomifo){
                    $roomno=$roomifo->roomno;
                    $roomrate=$roomifo->rate;
                    $categoryid=$roomifo->categoryid;
                    $categoryname=$roomifo->name;
                }
            
            }

            if($checkoutid > 0){
                $data2 = DB::table('vistercheckout_master')->where('id',$checkoutid)->orderBy('id', 'desc')->get(); 
                foreach($data2 as $visterdata){
                    $checkintime=$visterdata->checkintime;
                    $checkouttime=$visterdata->checkouttime;
                    $visitername=$visterdata->visternam;
                }
             }
             $date1 = strtotime($checkintime);  
            $date2 = strtotime($checkouttime); 

            $diff = abs($date2 - $date1);  

            $years = floor($diff / (365*60*60*24));  
             $months = floor(($diff - $years * 365*60*60*24) 
                                           / (30*60*60*24));  
            $days = floor(($diff - $years * 365*60*60*24 -  
                         $months*30*60*60*24)/ (60*60*24)); 
              
           
                         $result[]=array(
                            'roomno'=>$roomno,
                            'roomid'=>$roomid,
                            'categoryid'=>$categoryid,
                            'checkoutid'=>$checkoutid,
                            'checkintime'=>$checkintime,
                            'checkouttime'=>$checkouttime,
                            'visitername'=>$visitername,
                            'visterid'=>$visterid,
                            'days'=>$days,
                            'roomrate'=>$roomrate,
                            'categoryname'=>$categoryname,
                            'extraserviceamt'=>$extraserviceamt,
                        );

        }
        return $result;
    }
    function geteditserviceinfodetalis($id){
        $result=array();
     
        $data1 = DB::table('allocateroom')->where('invoiceid',$id)->orderBy('id', 'desc')->get();
       
       
        foreach($data1 as $allocatedata){
            $visterid=$allocatedata->visterid;
            $roomid=$allocatedata->roomid;
            $roomno=0;
           // dd($roomid."".$visterid);

           //echo $roomid."".$visterid;
            if($roomid >0){
               
                $data5 = DB::table('room_master')->where('id',$roomid)->get();
                foreach($data5 as $roomdata){
                    $roomno=$roomdata->roomno;
                }

                $data2 = DB::table('allocate_service')->where('visterid',$visterid)->where('roomid',$roomid)->get();
                   
                 
                
                foreach($data2 as $allocatedata){
                    $alocateid=$allocatedata->id;
                   
                    
                    $data3 = DB::table('allocate_servicedetalis')
                    ->join('extra_service', 'extra_service.id', '=', 'allocate_servicedetalis.serviceid')
                    ->select('allocate_servicedetalis.*', 'extra_service.servicename')
                    ->where('allocate_sid',$alocateid)->get();

                    foreach($data3 as $getservicedetalis){
                            $sum=0;
                            $rate=$getservicedetalis->rate;  
                            $qty=$getservicedetalis->qty; 
                            $servicename1=$getservicedetalis->servicename; 
                            $serviceid=$getservicedetalis->serviceid; 
                            $datetime=$getservicedetalis->datetime;
                            if($rate > 0 && $qty > 0){
                                $sum=$rate * $qty;
                            }
                            $result[]=array(
                                'rate'=>$rate,
                                'qty'=>$qty,
                                'servicename'=>$servicename1,
                                'serviceid'=>$serviceid,
                                'sum'=>$sum,
                                'datetimedata'=>$datetime,
                                'roomno'=>$roomno,
                            );
                    }
                }
            }
          

        }
        return $result;
    }
    public function getvisallocateinfo($id){
        $data1 = DB::table('allocateroom')
        ->join('room_master', 'room_master.id', '=', 'allocateroom.roomid')
        ->select('allocateroom.*', 'room_master.roomno')
        ->where('visterid',$id)
        ->where('checkoutid','>',0)
        ->whereNull('invoiceid')->orderBy('id', 'desc')->get();
        return Response::json($data1);
    }
    public function getroomwiseinvoice($visterid,$roomid){
        $result=array();
        $data1 = DB::table('allocateroom')->where('visterid',$visterid)->where('roomid',$roomid)->where('checkoutid','>',0)->whereNull('invoiceid')->orderBy('id', 'desc')->get();
        foreach($data1 as $allocatedata){
            $visterid=$allocatedata->visterid;
            $roomid=$allocatedata->roomid;
            $checkoutid=$allocatedata->checkoutid;
            $checkintime='';
            $checkouttime='';
            $visitername='';
            $roomno=0;
            $roomrate=0;
            $categoryid='';
            $categoryname='';
            $extraserviceamt=0;
            if($roomid >0){
               
                $data2 = DB::table('allocate_service')->where('visterid',$visterid)->where('roomid',$roomid)->get();
                foreach($data2 as $allocatedata){
                    $alocateid=$allocatedata->id;
                   
                    $data3 = DB::table('allocate_servicedetalis')->where('allocate_sid',$alocateid)->get();
                    foreach($data3 as $allocationdata){
                            $sum=0;
                            $rate=$allocationdata->rate;  
                            $qty=$allocationdata->qty;  
                            if($rate > 0 && $qty > 0){
                                $sum=$rate * $qty;
                            }else{
                                $sum=0;
                            }  
                            $extraserviceamt=$sum+$extraserviceamt; 
                    }
                }
            }
           


            if($roomid >0){
                $roomdata = DB::table('room_master')
                ->join('categorys', 'categorys.id', '=', 'room_master.categoryid')
                ->select('room_master.*', 'categorys.*','room_master.id as id')
                ->where('room_master.id',$roomid)->get();
                foreach($roomdata as $roomifo){
                    $roomno=$roomifo->roomno;
                    $roomrate=$roomifo->rate;
                    $categoryid=$roomifo->categoryid;
                    $categoryname=$roomifo->name;
                }
            
            }

            if($checkoutid > 0){
                $data2 = DB::table('vistercheckout_master')->where('id',$checkoutid)->orderBy('id', 'desc')->get(); 
                foreach($data2 as $visterdata){
                    $checkintime=$visterdata->checkintime;
                    $checkouttime=$visterdata->checkouttime;
                    $visitername=$visterdata->visternam;
                }
             }
             $date1 = strtotime($checkintime);  
            $date2 = strtotime($checkouttime); 

            $diff = abs($date2 - $date1);  

            $years = floor($diff / (365*60*60*24));  
             $months = floor(($diff - $years * 365*60*60*24) 
                                           / (30*60*60*24));  
            $days = floor(($diff - $years * 365*60*60*24 -  
                         $months*30*60*60*24)/ (60*60*24)); 
              
           
                         $result[]=array(
                            'roomno'=>$roomno,
                            'roomid'=>$roomid,
                            'categoryid'=>$categoryid,
                            'checkoutid'=>$checkoutid,
                            'checkintime'=>$checkintime,
                            'checkouttime'=>$checkouttime,
                            'visitername'=>$visitername,
                            'visterid'=>$visterid,
                            'days'=>$days,
                            'roomrate'=>$roomrate,
                            'categoryname'=>$categoryname,
                            'extraserviceamt'=>$extraserviceamt,
                        );

        }
        return $result;
    }
    public function getroomservice($visterid,$roomid){
        $result=array();
     
        $data1 = DB::table('allocateroom')->where('visterid',$visterid)->where('roomid',$roomid)->where('checkoutid','>',0)->whereNull('invoiceid')->orderBy('id', 'desc')->get();
        foreach($data1 as $allocatedata){
            $visterid=$allocatedata->visterid;
            $roomid=$allocatedata->roomid;
            if($roomid >0){
               
                $data2 = DB::table('allocate_service')->where('visterid',$visterid)->where('roomid',$roomid)->get();
                foreach($data2 as $allocatedata){
                    $alocateid=$allocatedata->id;
                   
                    
                    $data3 = DB::table('allocate_servicedetalis')
                    ->join('extra_service', 'extra_service.id', '=', 'allocate_servicedetalis.serviceid')
                    ->select('allocate_servicedetalis.*', 'extra_service.servicename')
                    ->where('allocate_sid',$alocateid)->get();

                    foreach($data3 as $getservicedetalis){
                            $sum=0;
                            $rate=$getservicedetalis->rate;  
                            $qty=$getservicedetalis->qty; 
                            $servicename1=$getservicedetalis->servicename; 
                            $serviceid=$getservicedetalis->serviceid; 
                            $datetime=$getservicedetalis->datetime;
                            if($rate > 0 && $qty > 0){
                                $sum=$rate * $qty;
                            }
                            $result[]=array(
                                'rate'=>$rate,
                                'qty'=>$qty,
                                'servicename'=>$servicename1,
                                'serviceid'=>$serviceid,
                                'sum'=>$sum,
                                'datetimedata'=>$datetime,
                            );
                    }
                }
            }
          

        }
        return $result;
    }
    public function geteditinroomnno($id){
        $data1 = DB::table('allocateroom')
        ->join('room_master', 'room_master.id', '=', 'allocateroom.roomid')
        ->select('allocateroom.*', 'room_master.roomno')
        ->where('checkoutid','>',0)
        ->where('invoiceid',$id)->orderBy('id', 'desc')->get();
        return Response::json($data1);
    }
    public function checkinvoicenoexists($invoiceno){
        $data2 = DB::table('invoice_master')->where('invoiceno',$invoiceno)->get();
        $count=count($data2);

        if($count >0){
            return '100';
        }else{
            return '0';
        }
    }
    public function checkeditinvoicenoexists($invoiceno,$id){
        $data2 = DB::table('invoice_master')->where('id','!=',$id)->where('invoiceno',$invoiceno)->get();
        $count=count($data2);
        if($count >0){
            return '100';
        }else{
            return '0';
        }
    }


}
