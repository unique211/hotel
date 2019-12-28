<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //
//     public function __construct()
// {
// $this->middleware(function ($request, $next) {

// $uInfo = Session::get('userid');
// if(isset($uInfo) && !empty($uInfo)){
// 	return redirect('dashboard');
// }
// return $next($request);
// });
// }
public function __construct()
{
    $this->middleware('usersession');
}
    public function index(Request $request){

        return view('login');
        // if (!$request->session()->exists('userid')) {
        //     // user value cannot be found in session
        //     return redirect('/');
        // } else{
        //     return view('login');
        // }
    }
}
