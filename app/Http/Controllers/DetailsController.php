<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Cart;

class DetailsController extends Controller
{

    public function index($slug) {
        $product = Product::where('slug', $slug)->firstorfail();
        $asd = Cart::content()->where('id', $product->id);
        $cart_data = 0;
        foreach ($asd as $row) {
        $cart_data = $row;
        }
// var_dump($cart_data->qty);
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        $related_products = @Product::where('category_id', $product->category_id)->inRandomOrder()->limit(5)->get();
        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['product' => $product, 'popular_products' => $popular_products, 'related_products' => $related_products, 
        'cart_data' => $cart_data, 'title' => $title, 'description' => $description,];
               
        return Inertia::render('Details', $data);
    }
}
