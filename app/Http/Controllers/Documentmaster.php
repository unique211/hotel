<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documentmastermodel;
use DB;;
class Documentmaster extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('usersession');
    }
    public function store(Request $request){
      
        $Document = new Documentmastermodel;
        $Document->doc_name = $request->doctype;
        $Document->docproff_no = $request->profdocno;
        $Document->filename = $request->filename;
        $Document->vid = $request->docid;
       
        $Document->save();
        return $Document;

    }
    public function edit($vid)
    {
       
        if(request()->ajax())
        {
           
          $results = Documentmastermodel::where('vid',$vid)->get();
           
           return response()->json($results);
        }
    }
    public function destroy($id)
    {
        $data = Documentmastermodel::where('vid',$id);
        $data->delete();
    }
}
