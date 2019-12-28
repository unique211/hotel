<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
class LanguageSwitcher
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
        App::setLocale(Session::has('locale') ? Session::get('locale') : Config::get('app.locale'));
    //    if (Session::has('locale') AND in_array(Session::get('locale'), Config::get('app.languages'))) {
    //     App::setLocale(Session::get('locale'));
      
    
    // }
    // else { // This is optional as Laravel will automatically set the fallback language if there is none specified
    //     App::setLocale(Config::get('app.fallback_locale'));
    // }

       
       return $next($request);
    }
}
