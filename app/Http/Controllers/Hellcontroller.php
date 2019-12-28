<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Customer;

class Hellcontroller extends Controller{

    public function index(){
        $subject=["guj","Eng","hindi"];
        $mark=["10","20","30"];
        return view('hello')->with(["subject"=>$subject,"mark"=>$mark]);
    }
    public function test($fname,$sname){
       echo '<h1>how are you </h1> '.$fname.'Sname'.$sname;
    }
    public function getchild(){
        $data=[
                ['name'=>'Sagar'],
                ['name'=>'Ravi'],
                ['name'=>'Ajaz'],
                ['name'=>'Mohit'],
        ];

        $customermaster=Customer::all();
        //dd($customermaster);

        return view('child',compact('data'));
     }

}

