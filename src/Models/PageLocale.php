<?php

namespace Ombimo\LarawebCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PageLocale extends Model
{
    protected $dates = [
        'created_at',
        'updated_at'
    ];

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

    public function addView()
    {
        $this->view += 1;
        $this->view_d += 1;
        $this->view_w += 1;
        $this->view_m += 1;
        $this->save();
    }
}
