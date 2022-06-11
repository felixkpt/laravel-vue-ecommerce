<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function popular() {
        $popular = Product::latest()->limit(5)->get();
        return response()->json($popular);
    }
}
