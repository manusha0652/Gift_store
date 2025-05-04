<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'price',
        'category',
        'quantity',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category');
    }
}
