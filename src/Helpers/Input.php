<?php

namespace Ombimo\LarawebCore\Helpers;

use Carbon\Carbon;
use Exception;

class Input
{
    public static function populateSelect($data, $selected = null, $keyName = null, $valueName = null)
    {
        $multi = is_array($selected);

        if ($keyName != null) {
            foreach ($data as $value) {
                $selectedAttribute = '';
                if ($multi) {
                    if (in_array($value[$keyName], $selected)) {
                        $selectedAttribute = 'selected';
                    }
                } elseif (strval($value[$keyName]) === strval($selected)) {
                    $selectedAttribute = 'selected';
                }

                echo '<option value="' . $value[$keyName] . '"' . $selectedAttribute . '>' . $value[$valueName] . '</option>';
            }
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $model
     * @param [type] $request
     * @param array $data
     * @return $model
     */
    public static function getInput($model, $request, $data)
    {
        foreach ($data as $key) {
            $model->{$key} = $request->{$key};
        }

        return $model;
    }

    public static function dateToDB($date, $format, $default = null)
    {
        $dateDB = $default;
        try {
            $date = Carbon::createFromFormat($format, $date);
            $dateDB = $date->format('Y-m-d');
        } catch (Exception $e) {
            return $dateDB;
        }

        return $dateDB;
    }

    public static function cleanNumber($text)
    {
        return preg_replace('/[^\d]/', '', $text);
    }
}
