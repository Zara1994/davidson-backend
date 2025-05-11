<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'type',
        'file',
        'text',
        'link',
        'is_active',
    ];
}
