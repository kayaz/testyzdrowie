<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;

class Language
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
        $locale = $request->route()->locale;

        if (array_key_exists($locale, config('app.available_locales'))) {
            session()->put('locale', $locale);
            app()->setLocale($locale);
            URL::defaults(['locale' => $locale]);
        } else {

            if($locale) {
                return redirect('/'.app()->getLocale());
            }
        }

        return $next($request);
    }
}
