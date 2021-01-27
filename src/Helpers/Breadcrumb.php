<?php

namespace Ombimo\LarawebCore\Helpers;

class Breadcrumb
{
    public static $items = [];

    public static function add($name, $link, $index = null)
    {
        $newItem = ['name' => $name, 'link' => $link];
        if ($index == null) {
            array_push(self::$items, $newItem);
        } else {
            self::$items[$index] = $newItem;
        }
    }

    public static function toScript()
    {
        if (self::count() <= 0) {
            return '';
        }

        $itemListElement = [];

        foreach (self::$items as $key => $item) {
            $itemListElement[] = [
                '@type' => 'ListItem',
                'position' => ($key + 1),
                'name' => $item['name'],
                'item' => $item['link'],
            ];
        }

        $breadcrumb = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $itemListElement,
        ];

        $start = '<script type="application/ld+json">';
        $end = '</script>';

        return $start . json_encode($breadcrumb) . $end;
    }

    public static function count()
    {
        return count(self::$items);
    }
}
