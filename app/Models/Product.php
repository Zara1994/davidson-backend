<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'sizes', 'description', 'image', 'category_id'];

    public function category()
    {
        return $this->belongsTo(related: Category::class);
    }
}
