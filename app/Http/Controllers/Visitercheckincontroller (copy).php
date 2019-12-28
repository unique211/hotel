<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Visitercheckinmodel;
use App\Exceptions\CustomException;
class Visitercheckincontroller extends Controller
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
        return view('visitercheckin');
    }
       
    }
    public function store(Request $request){
       

      $from1 = strtr($request->checktime, '/', '-');
        $checkintime = date('Y-m-d H:i:s', strtotime($from1));

        $from2 = strtr($request->date, '/', '-');
        $checkouttime = date('Y-m-d H:i:s', strtotime($from2));

        $Visitercheckinmodel = new Visitercheckinmodel;
        $Visitercheckinmodel->visiterid = $request->saveid1;
        $Visitercheckinmodel->men = $request->men;
        $Visitercheckinmodel->woman = $request->women;
        $Visitercheckinmodel->child = $request->child;
        $Visitercheckinmodel->checkintime =$checkintime;
        $Visitercheckinmodel->checkouttime =$checkouttime;
        $Visitercheckinmodel->noofday = $request->nodays;
        $Visitercheckinmodel->amount = $request->amount;
        $Visitercheckinmodel->advancepayment = $request->advanceamount;
        $Visitercheckinmodel->mode = $request->amtmode;
        $Visitercheckinmodel->remark = $request->remark;
        
      if ($Visitercheckinmodel->save()) {
            return $Visitercheckinmodel->id;
        }
 
}
public function showalldata(){
  //  throw new \App\Exceptions\CustomException('Something Went Wrong.');
  $result=array();
  $data = DB::table('visiter_master')->get();
  foreach($data as $visiterdata){
    $visterid=$visiterdata->id;
    $visitername=$visiterdata->visitername;
    $address=$visiterdata->address;
    $mobileno=$visiterdata->mobileno;
    $emailid=$visiterdata->emailid;
    $c_detalis=$visiterdata->c_detalis;
    $c_name=$visiterdata->c_name;
    $desighnation=$visiterdata->desighnation;
    $c_url=$visiterdata->c_url;

    $data1 = DB::table('Checkin_master')->where('visiterid',$visterid)->get();
    foreach($data1 as $checkingdata){
      $id=$checkingdata->id;
      $visterid=$checkingdata->visiterid;
     // $visitername=$visiterdata->visitername;
      $men=$checkingdata->men;
      $woman=$checkingdata->woman;
      $child=$checkingdata->child;
      $noofday=$checkingdata->noofday;
      $checkintime=$checkingdata->checkintime;
      $checkouttime=$checkingdata->checkouttime;
      $amount=$checkingdata->amount;
      $advancepayment=$checkingdata->advancepayment;
      $mode=$checkingdata->mode;
      $remark=$checkingdata->remark;

      $result[]=array(
        'id'=>$id,
        'visitername'=>$visitername,
        'address'=>$address,
        'mobileno'=>$mobileno,
        'emailid'=>$emailid,
        'c_detalis'=>$c_detalis,
        'c_name'=>$c_name,
        'desighnation'=>$desighnation,
        'c_url'=>$c_url,
        'c_contactno'=>$visitername,
        'c_emailid'=>$visitername,
        'men'=>$men,
        'woman'=>$woman,
        'child'=>$child,
        'noofday'=>$noofday,
        'checkintime'=>$checkintime,
        'checkouttime'=>$checkouttime,
        'amount'=>$amount,
        'advancepayment'=>$advancepayment,
        'mode'=>$mode,
        'remark'=>$remark,
        'visiterid'=>$visterid,
      );
    }

  }
    $data = DB::table('Checkin_master')
    ->join('visiter_master', 'visiter_master.id', '=', 'Checkin_master.visiterid')
    ->select('Checkin_master.*', 'visiter_master.*','Checkin_master.id as id')
    ->get();
    
    return response()->json($data);
}
public function update(Request $request)
{
  $from1 = strtr($request->checktime, '/', '-');
  $checkintime = date('Y-m-d H:i:s', strtotime($from1));

  $from2 = strtr($request->date, '/', '-');
  $checkouttime = date('Y-m-d H:i:s', strtotime($from2));
    
    $form_data = array(
        'visiterid'        =>  $request->saveid1,
        'men'    =>  $request->men,
        'woman'        =>  $request->women,
        'child'        =>  $request->child,
        'noofday'    =>  $request->nodays,
        'checkintime'        =>  $checkintime,
        'checkouttime'        =>  $checkouttime,
        'amount'        =>  $request->amount,
        'advancepayment'        =>  $request->advanceamount,
        'mode'        =>  $request->amtmode,
        'remark'        =>  $request->remark,
  
    );
   
    
  $id=  Visitercheckinmodel::whereId($request->updateid)->update($form_data);



    return response()->json($id);
}

}
