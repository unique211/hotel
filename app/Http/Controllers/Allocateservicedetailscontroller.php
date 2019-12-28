<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Allocateservicedetalismodel;
use Illuminate\Support\Facades\DB;

class Allocateservicedetailscontroller extends Controller
{
  //
  public function __construct()
  {
    $this->middleware('usersession');
  }
  public function index()
  { }
  public function store(Request $request)
  {

    // dd('hii');

    $from1 = strtr($request->datetime, '/', '-');
    $allocatetime = date('Y-m-d H:i:s', strtotime($from1)); //should be course_date
    $Allocateservicedetalismodel = new Allocateservicedetalismodel;
    $Allocateservicedetalismodel->allocate_sid = $request->allocatesid;
    $Allocateservicedetalismodel->datetime = $allocatetime;
    $Allocateservicedetalismodel->serviceid = $request->serviceid;
    $Allocateservicedetalismodel->rate = $request->rate;
    $Allocateservicedetalismodel->qty = $request->qty;
    $Allocateservicedetalismodel->save();
    return $Allocateservicedetalismodel;
  }
  public function edit($aid)
  {

    if (request()->ajax()) {

      $allocateservice = DB::table('allocate_servicedetalis')
        ->join('extra_service', 'extra_service.id', '=', 'allocate_servicedetalis.serviceid')
        ->select('allocate_servicedetalis.*', 'extra_service.servicename', 'extra_service.id as serviceid')
        ->where('allocate_sid', $aid)
        ->get();
      return response()->json($allocateservice);
    }
  }
  public function destroy($id)
  {
    $data = Allocateservicedetalismodel::where('allocate_sid', $id);
    $data->delete();
    //return $data;
    return response()->json($data);
  }
}
