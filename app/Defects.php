<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Defects extends Model
{
    protected $priority = ['critical', 'low', 'medium', 'high'];
    protected $fillable = [
        'description', 'priority'
    ];

    public function getPriority()
    {
        return $this->priority;
    }
}
