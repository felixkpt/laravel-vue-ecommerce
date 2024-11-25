<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeProduct extends Model
{
    use HasFactory;

    protected $table = 'home_products';

    protected $fillable = ['products', 'no_of_products'];
}
