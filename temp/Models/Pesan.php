<?php

namespace Ombimo\LarawebCore\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = 'pesan';

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
