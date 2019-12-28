<?php

namespace App\Http\Middleware;
use Session;
use Redirect;
use Closure;
use Illuminate\Support\Facades\Response;

class CheckUserSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) 
    {
        // if (!$request->session()->exists('userid')) {
        //     $response=$next($request);
        //     return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
        //     ->header('Pragma','no-cache')
        //     ->header('Expires','Sat, 26 Jul 1997 05:00:00 GMT');

        // return redirect('/');
           
        // }
       // return $next($request);
        $response = $next($request);

        return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
                ->header('Pragma','no-cache')
                ->header('Expires','Sat, 26 Jul 1997 05:00:00 GMT');
    }
}
