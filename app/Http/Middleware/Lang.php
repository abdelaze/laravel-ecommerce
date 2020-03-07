<?php

namespace App\Http\Middleware;

use Closure;

class Lang
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
        //session()->has('lang') ?   app()->setLocale(session('lang')) :   app()->setLocale('ar');

       app()->setLocale(lang()); // lang() the helper function that i made
        return $next($request);
    }
}
