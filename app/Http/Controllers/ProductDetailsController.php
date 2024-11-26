<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;
use Cart;

class ProductDetailsController extends Controller
{

    public function index($slug)
    {
        $product = Product::where('slug', $slug)->firstorfail();
        $asd = Cart::content()->where('id', $product->id);
        $cart_data = 0;
        foreach ($asd as $row) {
            $cart_data = $row;
        }

        $popular_products = Product::inRandomOrder()->limit(4)->get();
        $related_products = Product::where('id', '!=', $product->id)->where('category_id', $product->category_id);
        $title = 'Related Products';
        $description = '';
        if ($related_products->count() === 0) {
            $title = 'More Products';
            $related_products = Product::where('id', '!=', $product->id);
        }

        $related_products = $related_products->inRandomOrder()->limit(5)->get();


        $data = [
            'product' => $product,
            'popular_products' => $popular_products,
            'related_products' => $related_products,
            'most_viewed' => $related_products,
            'cart_data' => $cart_data,
            'title' => $title,
            'description' => $description,
        ];

        return Inertia::render('ProductDetails', $data);
    }
}
