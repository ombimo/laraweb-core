<?php

namespace Ombimo\LarawebCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PageSegmentLocale extends Model
{
    protected $table = 'page_segment_locales';

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
