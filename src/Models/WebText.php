<?php

namespace Ombimo\LarawebCore\Models;

use Illuminate\Database\Eloquent\Model;

class WebText extends Model
{
    protected $table = 'web_text';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
