<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'sender', 'name', 'to', 'from', 'subject', 'message',
    ];
}
