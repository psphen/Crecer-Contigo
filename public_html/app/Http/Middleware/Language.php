<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session('applocale')){
            $configLanguage = config('languages')[session('applocale')];
//            $configLanguage[1]
            setlocale(LC_TIME,   'es_ES.utf8');
            Carbon::setLocale(session('applocale'));
            App::setLocale(session('applocale'));
        }else{
            session()->put('applocale', config('app.fallback_locale'));
            setlocale(LC_TIME, 'en_EN.utf8');
            Carbon::setLocale(session('applocale'));
            App::setLocale(session('applocale'));
        }
        return $next($request);
    }
}
