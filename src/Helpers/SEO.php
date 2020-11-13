<?php

namespace Ombimo\LarawebCore\Helpers;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Storage;

class SEO extends SEOTools
{
    public static function setImage($path = null) {
        $defaultImg = config('seo.default_image.path');
        $defaultHeight = config('seo.default_image.height');
        $defaultWidth = config('seo.default_image.width');

        if ( Storage::disk('public')->exists($path)) {
            $dim = get_dimension($path);
            $publicPath = asset(Storage::disk('public')->url($path));

            SEO::opengraph()->addImage(
                $publicPath,
                [
                    'height' => $dim['height'],
                    'width' => $dim['width']
                ]
            );
            SEO::twitter()->addImage($publicPath);
        } elseif ($defaultImg != null) {
            SEO::opengraph()
                ->addImage(
                asset($defaultImg),
                [
                    'height' => $defaultHeight,
                    'width' => $defaultWidth
                ]
            );
            SEO::twitter()->addImage(asset($defaultImg));
        }
    }
}
