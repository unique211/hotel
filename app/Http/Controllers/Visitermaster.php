<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visitermastermodel;
use Illuminate\Support\Facades\DB;

class Visitermaster extends Controller
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

        return view('visitermaster');
    }

    }
    public function store(Request $request){


      $data= DB::table('visiter_master')->where('mobileno',$request->mobileno)->get();
      $count=count($data);
        if($count==0){
          $Visitermastermodel = new Visitermastermodel;
          $Visitermastermodel->visitername = $request->name;
          $Visitermastermodel->lastname = $request->lastname;
          $Visitermastermodel->address = $request->address1;
          $Visitermastermodel->address2 = $request->address2;
          $Visitermastermodel->street = $request->street;
          $Visitermastermodel->city = $request->city;
          $Visitermastermodel->postalcode = $request->postalcode;
          $Visitermastermodel->state = $request->state;
          $Visitermastermodel->mobileno = $request->mobileno;
          $Visitermastermodel->emailid = $request->email;
          $Visitermastermodel->c_detalis = $request->comapanydata;
          $Visitermastermodel->c_name = $request->c_name;
          $Visitermastermodel->desighnation = $request->desgination;
          $Visitermastermodel->c_url = $request->url;
          $Visitermastermodel->c_emailid = $request->c_email;
          $Visitermastermodel->c_contactno = $request->contactno;
          $Visitermastermodel->profilepicture = $request->pfilehidden1;


          if ($Visitermastermodel->save()) {
              return $Visitermastermodel->id;

          }
        }else{
          return '0';
        }


}
public function uploadingdoc(Request $request){

  //  $token = $this->getTokenFromRequest($request);
    $extension = $request->file('file')->getClientOriginalExtension();

    $dir = 'uploads/';
    $filename = uniqid() . '_' . time() . '.' . $extension;

   // echo  dd($filename);
    $request->file('file')->move($dir, $filename);


    return $filename;

 }
 public function allvisiterdata(){

  return Visitermastermodel::latest()->get();

 }
 public function update(Request $request)
{
  $data= DB::table('visiter_master')->where('mobileno',$request->mobileno)->where('id','!=',$request->saveid)->get();
  $count=count($data);

    if($count==0){
    $form_data = array(
        'visitername'        =>  $request->name,
        'address'    =>  $request->address1,
        'mobileno'        =>  $request->mobileno,
        'emailid'        =>  $request->email,
        'c_detalis'    =>  $request->comapanydata,
        'c_name'        =>  $request->c_name,
        'desighnation'        =>  $request->desgination,
        'c_url'        =>  $request->url,
        'c_emailid'        =>  $request->c_email,
        'c_contactno'        =>  $request->contactno,
        'lastname'        =>  $request->lastname,
        'address2'        =>  $request->address2,
        'street'        =>  $request->street,
        'city'        =>  $request->city,
        'postalcode'        =>  $request->postalcode,
        'state'        => $request->state,
        'profilepicture'        => $request->pfilehidden1,

    );


  $id=  Visitermastermodel::whereId($request->saveid)->update($form_data);



    return response()->json($id);

  }else{
    return '0';
  }
}
public function destroy($id)
{
    $data = Visitermastermodel::findOrFail($id);
    $data->delete();
    return response()->json($data);
}
 public function searchvisiterdata($content)
{
  $data= Visitermastermodel::where('visitername', 'like', '%' . $content . '%')->get();
  return response()->json($data);
}
public function avalible_roomdata(){
  $result=array();
  $users = DB::table('categorys')->get();
foreach($users as $data){
  $id= $data->id;
  $name= $data->name;
  $name= $data->name;
  $rate=$data->rate;
  $capacity=$data->capacity;
  $roomdata1=array();
      $roomdata= DB::table('room_master')->get()->where('categoryid',$id)->where('status',1);
        foreach($roomdata as $getrom){
          $roomno=$getrom->roomno;
          $roomid=$getrom->id;
          $roomname=$getrom->roomname;
          $description=$getrom->description;

          $roomdata1[]=array(
            'roomno'=>$roomno,
            'roomid'=>$roomid,
            'description'=>$description,
            'roomname'=>$roomname,
          );
        }

        if(!empty($roomdata1)){
          $result[]=array(
            'cateid'=>$id,
            'catname'=>$name,
            'roomdata'=>$roomdata1,
            'rate'=>$rate,
            'capacity'=>$capacity,
          );
        }


}


  return response()->json($result);
}
public function checkmobileno($mobileno){
  //dd($mobileno);

  $data= DB::table('visiter_master')->where('mobileno',$mobileno)->get();
  $count=count($data);

  return response()->json($count);
}
public function profileimguploadingfile(Request $request){

  $extension = $request->file('profile')->getClientOriginalExtension();

  $dir = 'profileuploads/';
  $filename = uniqid() . '_' . time() . '.' . $extension;


  $request->file('profile')->move($dir, $filename);


  return $filename;
}
public function getholeinformation($visitor){
  $result=array();
  $data= DB::table('Checkin_master')->where('visiterid',$visitor)->get();
  foreach($data as $chechindata){
    $men=$chechindata->men;
    $woman=$chechindata->woman;
    $child=$chechindata->child;
    $noofday=$chechindata->noofday;
    $checkintime=$chechindata->checkintime;
   // $checkouttime=$chechindata->checkouttime;
    $amount=$chechindata->amount;
    $advancepayment=$chechindata->advancepayment;
    $mode=$chechindata->mode;
    $checkouttime="";
    $totalamount="";
    $transactiondetal="";
    $roomdata=array();

    $invoiceid="";
    $invoiceno="";
    $invoicetotal="";


    $data1= DB::table('vistercheckout_master')->where('visterid',$visitor)->where('checkintime',$checkintime)->get();
    foreach($data1 as $checkoutinfo){
      $checkouttime=$checkoutinfo->checkouttime;
      $totalamount=$checkoutinfo->totalamout;
      $transactiondetal=$checkoutinfo->transactiondetal;
    }

    $data2= DB::table('allocateroom')->where('visterid',$visitor)->where('checkintime',$checkintime)->get();
    foreach($data2 as $allocateroominfo){
      $roomid=$allocateroominfo->roomid;
      $roomrate=$allocateroominfo->roomrate;
      $roomno='';
      $roomname='';
      $catrogoryid='';

      $data3= DB::table('room_master')->where('id',$roomid)->get();
      foreach($data3 as $roommasterdata){
        $roomno=$roommasterdata->roomno;
        $roomname=$roommasterdata->roomname;
        $categoryid=$roommasterdata->categoryid;

      }
      $roomdata[]=array(
        'roomno'=>$roomno,
        'roomname'=>$roomname,
        'categoryid'=>$categoryid,
        'roomrate'=>$roomrate,

      );


    }
    $data4 = DB::table('invoice_detalis')
            ->select('invoice_detalis.*', 'invoice_master.invoiceno', 'invoice_master.invoicedate','invoice_master.totalamt')
            ->join('invoice_master', 'invoice_master.id', '=', 'invoice_detalis.invoiceid')
            ->where('invoice_master.visiterid',$visitor)
            ->where('invoice_detalis.checkintime',$checkintime)
            ->get();
            foreach($data4 as $invoicedata){
              $invoiceid=$invoicedata->invoiceid;
              $invoiceno=$invoicedata->invoiceno;
              $invoicetotal=$invoicedata->totalamt;
            }

            $result[]=array(
              'men'=>$men,
              'woman'=>$woman,
              'child'=>$child,
              'noofday'=>$noofday,
              'checkintime'=>$checkintime,
              'amount'=>$amount,
              'checkouttime'=>$checkouttime,
              'checkouttime'=>$checkouttime,
              'roomdata'=>$roomdata,
              'invoiceid'=>$invoiceid,
              'invoiceno'=>$invoiceno,
              'invoicetotal'=>$invoicetotal,


            );

  }
  return $result;


}

}
