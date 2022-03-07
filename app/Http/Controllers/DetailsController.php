<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DetailsController extends Controller
{

    public function index($slug) {
        $product = Product::where('slug', $slug)->first();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        $related_products = @Product::where('category_id', $product->category_id)->inRandomOrder()->limit(5)->get();
        return Inertia::render('Details', ['product' => $product, 'popular_products' => $popular_products, 'related_products' => $related_products]);
    }
}
