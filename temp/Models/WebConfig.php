<?php

namespace Ombimo\LarawebCore\Models;

use Illuminate\Database\Eloquent\Model;

class WebConfig extends Model
{
    protected $table = 'web_config';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
