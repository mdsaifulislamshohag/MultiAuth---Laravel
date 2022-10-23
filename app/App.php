<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $fillable = [
        'name', 'location', 'details', 'image', 'category', 'moto',
    ];
}
