<?php

namespace Ombimo\LarawebCore;

class Segment
{
    public static $segment = null;

    function __construct($segment)
    {
        self::$segment = $segment;
    }

    public static function get($name, $default = null, $locale = false)
    {
        if (self::$segment == null) {
            return $default;
        }

        $data = self::$segment->where('name', $name)->first();
        if ($data != null) {
            if ($locale) {
                return $data->locale_value;
            } else {
                return $data->value;
            }
        }

        return $default;
    }

    public static function locale($name, $default = null)
    {
        return self::get($name, $default, true);
    }
}
