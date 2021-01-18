<?php

namespace Ombimo\LarawebCore\Helpers;

use Illuminate\Support\Facades\Session;


class Alert
{
    public static $type = '';

    public static $msg = '';

    public static function set($type, $msg, $session = true)
    {
        if ($session) {
            Session::flash('laraweb_core.alert.type', $type);
            Session::flash('laraweb_core.alert.msg', $msg);
        } else {
            self::$type = $type;
            self::$msg = $msg;
        }

    }

    public static function get()
    {
        return view('_core.alert', [
            'type' => Session::get('laraweb_core.alert.type', self::$type),
            'msg' => Session::get('laraweb_core.alert.msg', self::$msg),
        ]);
    }
}
