<?php

namespace Ombimo\LarawebCore;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $themes = 'default';

    public function view($view = null, $data = [], $mergeData = [])
    {
        $this->themes = config('laraweb.theme');

        $factory = app(ViewFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        if (View::exists($this->themes . '.' . $view)) {
            $view = $this->themes . '.' . $view;
        } else {
            $view = 'default.' . $view;
        }

        return $factory->make($view, $data, $mergeData);
    }

}
