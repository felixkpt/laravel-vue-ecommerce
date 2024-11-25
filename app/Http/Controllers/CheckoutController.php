<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Cart;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        if (!auth()->id()) {
            return redirect()->to('login');
        }

        $cart_data = $this->cart();
        $title = 'Welcome to quick shoppers';
        $description = '';

        $products = Product::where('id', '>', 0)->limit(15)->get();

        $data = ['cart_data' => $cart_data, 'most_viewed' => $products, 'title' => $title, 'description' => $description,];

        return Inertia::render('Checkout', $data);
    }

    public function cart()
    {
        $cart = json_decode(Cart::content());
        $subtotal = Cart::subtotal();
        $tax = Cart::tax();
        $total = Cart::total();
        $count = Cart::count();
        return ['cart' => $cart, 'subtotal' => $subtotal, 'tax' => $tax, 'total' => $total, 'count' => $count];
    }
}
