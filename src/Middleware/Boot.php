<?php

namespace Ombimo\LarawebCore\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;
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
        $kontak = WebKontak::get();
        Web::setKontak($kontak);

        return $next($request);
    }
}
