<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Redirect;

class LanguagesController extends Controller
{
    //
    // public function chooser(REQUEST $request){
          
    //         Session::put('locale',$request->languages);
    //         return Redirect("/");
    // }

    public function index(Request $request){
       

        if(!\Session::has('locale'))
        {
            \Session::put('locale', $request->languages);
        }else{
            session(['locale' => $request->languages]);
        }
        return Redirect::back();
    }
}
