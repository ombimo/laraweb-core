<?php

namespace Ombimo\LarawebCore\Middleware;

use Closure;
use Illuminate\Http\Request;
use Ombimo\LarawebCore\Helpers\Web;
use Ombimo\LarawebCore\Models\WebKontak;

class Boot
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

        Web::setKontak(WebKontak::get());
        Web::setConfig(WebKontak::get());
        Web::setText(WebKontak::get());

        return $next($request);
    }
}
