<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'regular_price',
        'sale_price',
        'SKU',
        'stock_status',
        'sale_quantity',
        'image',
        'category_id',
        'rating',
        'review_counts',
    ];

    public function category()
    {
        return $this->hasMany(Category::class, 'id', 'category_id');
    }
}
