<?php

namespace Ombimo\LarawebCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class PageSegment extends Model
{
    protected $table = 'page_segments';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function locale()
    {
        $locale = App::getLocale();

        return $this->hasOne('Ombimo\LarawebCore\Models\PageSegmentLocale', 'segment_id')->where('locale', $locale);
    }

    public function getLocaleValueAttribute()
    {
        return $this->locale ? $this->locale->value : $this->value;
    }
}
