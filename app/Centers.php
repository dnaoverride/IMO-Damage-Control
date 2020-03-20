<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centers extends Model
{
    protected $fillable = [
        'name', 'address', 'phone'
    ];
}
