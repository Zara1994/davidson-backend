<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Указываем, какие поля разрешены для массового присваивания
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'message',
    ];
}
