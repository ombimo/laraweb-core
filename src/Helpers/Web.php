<?php

namespace Ombimo\LarawebCore\Helpers;

class Web
{
    public static $menuName = '';

    public static $kontak = null;

    public static function setKontak($kontak)
    {
        self::$kontak = $kontak;
    }

    public static function getKontak($name, $default = null)
    {
        if (self::$kontak == null) {
            return $default;
        }

        $data = self::$kontak->where('name', $name)->first();
        if ($data != null) {
            return $data->value;
        }

        return $default;
    }

    public static function getSocial($name = null, $default = null)
    {
        if (self::$kontak == null) {
            return $default;
        }

        if ($name == null) {
            $data = self::$kontak->where('is_social_media', 1)->all();
            return $data;
        }

        $data = self::$kontak->where('is_social_media', 1)->where('name', $name)->first();
        if ($data != null) {
            return $data->value;
        }

        return $default;
    }

    public static function isMenu($name, $class = 'active')
    {
        return self::$menuName == $name ? $class : '';
    }

    public static function setMenu($menuName)
    {
        self::$menuName = $menuName;
    }
}
