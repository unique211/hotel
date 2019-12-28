<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departmentmaster;
use DB;

class Department extends Controller
{
   
    public function index(){
       
       
     }
     public function getdepartmentdata(){
        $department=DB::table('departmentmaster')->get();
        return response()->json($department); 
         
     }
}
