<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'slug',
        'quantity',
        'price',
        'inStock',
        'published',
        'description',
        'user_id',
        'brand_id',
        'category_id',
    ];
}
