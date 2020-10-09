<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

if (!function_exists ('url_page')) {
    function url_page ($slug) {
        return route('page', [
            'slug' => $slug,
        ]);
    }
}

if ( ! function_exists('get_thumbnail')) {
    function get_thumbnail($image, $maxWidth = 100, $maxHeight = 100, $default = 'images/no-photo.png')
    {
        $response = $default;

        /**
         * fix ketika directory separator yang tidak sama
         */
        $image = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $image);

        //Log::debug($image);

        //jika image kosong return default
        if ($image == '' || !Storage::disk('public')->exists($image)) {
            return asset($default);
        }

        try {
            $path_parts = pathinfo($image);
            $dir = $path_parts['dirname'];
            $filename = $path_parts['filename'];
            $ext = $path_parts['extension'];
            $thumbnail = '';
            if ($dir != DIRECTORY_SEPARATOR) {
                $thumbnail = $dir.'/';
            }

            $thumbnail .= '_thumbnail/'.$maxWidth.'x'.$maxHeight.'/'.$filename . '.' . $ext;

            //cek jika thumbnail sudah ada
            if (Storage::disk('public')->exists($thumbnail)) {
                return Storage::disk('public')->url($thumbnail);
            }


            $tempMemory = ini_get('memory_limit');
            ini_set('memory_limit', '512M');
            //Log::info('Memory Limit' . ini_get('memory_limit'));

            $img = Image::make(Storage::disk('public')->get($image))
                    ->resize($maxHeight, $maxWidth, function ($constraint) {
                        $constraint->upsize();
                        $constraint->aspectRatio();
                    })->interlace(true);

            $img->interlace(true)->encode(get_image_ext($img->mime()));

            if (Storage::disk('public')->put($thumbnail, $img->__toString())) {
                $response = Storage::disk('public')->url($thumbnail);
            } else {
                $response = asset($default);
            }

            ini_set('memory_limit', $tempMemory);

        } catch(\Exception $e) {
            $response = asset($default);
        }

        return $response;
    }
}

if(!function_exists('get_image_ext')) {
    function get_image_ext($mime) {
        switch ($mime) {
            case 'image/gif':
                return 'gif';
                break;
            case 'image/png':
                return 'png';
                break;
            case 'image/jpeg':
                return 'jpg';
                break;
            default:
                return 'jpg';
                break;
        }
    }
}

if(!function_exists('get_dimension')) {
    function get_dimension($imgPath) {
        if (Cache::has('height_'.$imgPath) AND Cache::has('width_'.$imgPath)) {
            $h = Cache::get('height_'.$imgPath);
            $w = Cache::get('width_'.$imgPath);
        } else {
            $im = Image::make(Storage::disk('public')->get($imgPath));
            $h = $im->height();
            $w = $im->width();
        }
        Cache::put('height_'.$imgPath, $h, 10000);
        Cache::put('width_'.$imgPath, $w, 10000);
        return [
            'width' => $w,
            'height' => $h
        ];
    }
}
