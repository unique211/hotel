<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use DB;;
class Documentdata extends Controller
{
    //

    public function store(Request $request){
        // $form_data = array(
        //     'name'        =>  $request->name,
        //     'address'      =>  $request->address,
        //     'dob'           =>  date("Y-m-d", strtotime($request->dob)),
        //     'email'        =>  $request->email,
        //     'mobileno'         =>  $request->mobileno,
            
        // );
        $Document = new Document;
        $Document->doc_name = $request->doctype;
        $Document->docproff_no = $request->profdocno;
        $Document->filename = $request->filename;
        $Document->vid = $request->docid;
       
        $Document->save();
        return $Document;

        //Employee::create($form_data);
      //  return Response::json(array('success' => true, 'last_insert_id' => $data->id), 200);
        //return response()->json(['success' => 'Data Added successfully.']);
     
    }
    public function edit($empid)
    {
        if(request()->ajax())
        {
            //$data = Document::findOrFail($empid);
          //  $user = DB::table('users')->where('name', 'John')->first();
          $results = Document::where('empid',$empid)->get();
           
           return response()->json($results);
        }
    }
    public function destroy($id)
    {
        $data = Document::where('empid',$id);
        $data->delete();
    }
}
