<?php

namespace Ombimo\LarawebCore\Helpers;

use Spatie\SchemaOrg\Schema;

class Alert
{
    public static $type;

    public static $msg;

    public static function set($type, $msg)
    {
        self::$type = $type;
        self::$msg = $msg;
    }

    public static function get()
    {
        return view('_core.alert', [
            'type' => self::$type,
            'msg' => self::$msg,
        ]);
    }
}
