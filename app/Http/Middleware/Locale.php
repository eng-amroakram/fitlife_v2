<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = $request->query('lang', $request->header('Accept-Language'));

        $dir = in_array($lang, ['ar']) ? 'rtl' : 'ltr';

        session()->put('dir', $dir);

        if ($lang) {
            app()->setLocale($lang);
            session()->put('lang', $lang);
        }

        return $next($request);
    }
}
