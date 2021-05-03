<?php

namespace Ombimo\LarawebCore\Helpers;

class Web
{
    public static $menuName = '';

    public static $kontak = null;

    public static $text = null;

    public static $config = null;

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
        if ($name != null) {
            if (self::$kontak === null) {
                return $default;
            }

            $data = self::$kontak->where('is_social_media', 1)->where('name', $name)->first();
            if ($data != null) {
                return $data->value;
            }

            return $default;
        }

        if (self::$kontak === null) {
            return [];
        }

        $data = self::$kontak->where('is_social_media', 1)->all();
        return $data ?? [];
    }

    public static function isMenu($name, $class = 'active')
    {
        return self::$menuName == $name ? $class : '';
    }

    public static function setMenu($menuName)
    {
        self::$menuName = $menuName;
    }

    public static function setText($text)
    {
        self::$text = $text;
    }

    public static function getText($name, $default = null)
    {
        if (self::$text == null) {
            return $default;
        }

        $data = self::$text->where('name', $name)->first();
        if ($data != null) {
            return $data->value;
        }

        return $default;
    }

    public static function setConfig($config)
    {
        self::$config = $config;
    }

    public static function getConfig($name, $default = null)
    {
        if (self::$config == null) {
            return $default;
        }

        $data = self::$config->where('name', $name)->first();
        if ($data != null) {
            return $data->value;
        }

        return $default;
    }
}
