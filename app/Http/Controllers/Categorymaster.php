<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\DB;
use Validator;

class Categorymaster extends Controller

{

    public function __construct()
{
    $this->middleware('usersession');
}
    public function index(Request $request){

        if (!$request->session()->exists('userid')) {
            // user value cannot be found in session
            return redirect('/');
        } else{
            return view('category');
        }
        
       
    }
    public function store(Request $request){

        $catdata = DB::table('categorys')->where('name',$request->name)->get();
         $count=count($catdata);
         if($count >0 ){
            return '100';
         }else{

        $Category = new Category;
        $Category->name = $request->name;
        $Category->capacity = $request->capacity;
        $Category->rate = $request->rate;
        $Category->descroption = $request->descriptiondata;
        if ($Category->save()) {
            return $Category->id;
        
        }
    }

        //Employee::create($form_data);
      //  return Response::json(array('success' => true, 'last_insert_id' => $data->id), 200);
        //return response()->json(['success' => 'Data Added successfully.']);
     
    
}
public function showalldata(){
   
  // echo 'hii';
    return Category::latest()->get();
}
public function update(Request $request)
{
    
    $catdata = DB::table('categorys')->where('name',$request->name)->where('id','!=',$request->saveid)->get();
    $count=count($catdata);
    if($count >0){
        return '100';
    }else{
        $form_data = array(
            'name'        =>  $request->name,
            'capacity'         =>  $request->capacity,
            'rate'        =>  $request->rate,
            'descroption'        =>  $request->descriptiondata,
      
        );
     
      $id=  Category::whereId($request->saveid)->update($form_data);
    
        return response()->json($id);
    }

    
}
public function destroy($id)
{
    $catdata = DB::table('room_master')->where('categoryid',$id)->get();
   $count=count($catdata);

if($count==0){
    $data = Category::findOrFail($id);
    $data->delete();

    return response()->json($data); 
}else{
    return response()->json('100'); 
}
   
}
public function checkexistcatname($name){
    $catdata = DB::table('categorys')->where('name',$name)->get();
    $count=count($catdata);
    return response()->json($count); 
}
public function checkeditexistcatename($name,$id){
    $catdata = DB::table('categorys')
    ->where('id','!=',$id)
    ->where('name',$name)
    ->get();
    $count=count($catdata);
    return response()->json($count); 
}

}