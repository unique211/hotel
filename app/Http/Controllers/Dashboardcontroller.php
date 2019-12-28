<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboardcontroller extends Controller
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
            return view('dashboard');
        }
    }
}
