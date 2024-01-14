<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactAudit extends Model
{
    //

    protected $fillable = [
        'ip', 'user_agent', 'name', 'email', 'subject', 'message', 'is_blocked'
    ];
}
