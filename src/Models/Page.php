<?php

namespace Ombimo\LarawebCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function locale()
    {
        $locale = App::getLocale();

        return $this->hasOne('Ombimo\LarawebCore\Models\PageLocale')->where('locale', $locale);
    }

    public function segments()
    {

        return $this->hasMany('Ombimo\LarawebCore\Models\PageSegment');
    }

    public function scopePublish($query)
    {
        return $query->where('publish', true);
    }

    public function scopeDefaultSort($query)
    {
        return $query->orderByDesc('created_at');
    }

    public function getSinopsisAttribute()
    {
        if (empty($this->sinopsis)) {
            $sinopsis = Str::limit(strip_tags($this->isi), 200, '');
        } else {
            $sinopsis = $this->sinopsis;
        }

        return $sinopsis;
    }

    public function getLocaleJudulAttribute()
    {
        return $this->locale ? $this->locale->judul : $this->judul;
    }

    public function getLocaleIsiAttribute()
    {
        return $this->locale ? $this->locale->isi : $this->isi;
    }

    public function getLocaleSinopsisAttribute()
    {
        return $this->locale ? $this->locale->sinopsis : $this->sinopsis;
    }

    public function addView()
    {
        $this->view += 1;
        $this->view_d += 1;
        $this->view_w += 1;
        $this->view_m += 1;
        $this->save();
    }
}
