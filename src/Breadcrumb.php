<?php

namespace Ombimo\LarawebCore;

use Spatie\SchemaOrg\Schema;

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

        $breadcrumb = [];

        foreach (self::$items as $key => $item) {
            $breadcrumb[] = Schema::listItem()
                ->name($item['name'])
                ->item($item['link'])
                ->position($key + 1);
        }

        $schemaBreadcrumb = Schema::BreadcrumbList()->itemListElement($breadcrumb);

        return $schemaBreadcrumb->toScript();
    }

    public static function count()
    {
        return count(self::$items);
    }
}
