<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Response;
use Redirect;
use Illuminate\Support\Facades\Auth;
use  Illuminate\Support\Facades\Cookie;
class Logoutcontroller extends Controller
{
   
    public function index(Request $request){
      header("cache-Control: no-store, no-cache, must-revalidate");
      header("cache-Control: post-check=0, pre-check=0", false);
      header("Pragma: no-cache");
      header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
      Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        Session::flash('succ_message', 'Logged out Successfully');
       // Redirect::back();
        return redirect('/');
      //  return view('login');
    }
}
