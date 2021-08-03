<?php

namespace Ombimo\LarawebCore\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Ombimo\LarawebCore\Helpers\Web;
use Ombimo\LarawebCore\Models\WebConfig;
use Ombimo\LarawebCore\Models\WebKontak;
use Ombimo\LarawebCore\Models\WebText;

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
        if (config('laraweb.cache')) {
            Web::setKontak(Cache::remember('laraweb_kontak', 3600, function () {
                return WebKontak::get();
            }));
            Web::setConfig(Cache::remember('laraweb_config', 3600, function () {
                return WebConfig::get();
            }));
            Web::setText(Cache::remember('laraweb_text', 3600, function () {
                return WebText::get();
            }));
        } else {
            Web::setKontak(WebKontak::get());
            Web::setConfig(WebConfig::get());
            Web::setText(WebText::get());
        }

        return $next($request);
    }
}
