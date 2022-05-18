<?php

namespace Ombimo\LarawebCore\Helpers;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Storage;

class SEO extends SEOTools
{
    public static function setCanonical($url)
    {
        SEO::metatags()->setCanonical($url);
        SEO::opengraph()->setUrl($url);
    }

    public static function setImage($path = null)
    {
        $defaultImg = config('seo.default_image.path');
        $defaultHeight = config('seo.default_image.height');
        $defaultWidth = config('seo.default_image.width');

        if (! empty($path) && Storage::disk('public')->exists($path)) {
            $dim = get_dimension($path);
            $publicPath = Storage::disk('public')->url($path);
            $publicPath = str_replace('\\', '/', $publicPath);

            SEO::opengraph()->addImage(
                $publicPath,
                [
                    'height' => $dim['height'],
                    'width' => $dim['width'],
                ]
            );
            SEO::twitter()->addImage($publicPath);
        } elseif ($defaultImg != null) {
            SEO::opengraph()
                ->addImage(
                    asset($defaultImg),
                    [
                        'height' => $defaultHeight,
                        'width' => $defaultWidth,
                    ]
                );
            SEO::twitter()->addImage(asset($defaultImg));
        }
    }
}
