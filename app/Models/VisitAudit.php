<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitAudit extends Model
{
    //

    protected $fillable = [
        'ip', 'user_agent', 'page'
    ];
}
