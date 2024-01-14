<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{

    protected $fillable = [
        'ip',
        'date',
        'raw_page',
        'actual_page',
        'count',
        'user_id',
    ];
}
