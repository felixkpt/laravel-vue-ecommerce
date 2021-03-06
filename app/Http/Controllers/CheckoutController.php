<?php

namespace App\Http\Controllers;

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
    public function index(Request $request){

        $cart_data = $this->cart();
        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['cart_data' => $cart_data, 'title' => $title, 'description' => $description,];
    //  dd($cart_data->count);
        return Inertia::render('Checkout', $data);
    }
    
    public function cart() {
        $cart = json_decode(Cart::content());
        $subtotal = Cart::subtotal();
        $tax = Cart::tax();
        $total = Cart::total();
        $count = Cart::count();
        return ['cart' => $cart, 'subtotal' => $subtotal, 'tax' => $tax, 'total' => $total, 'count' => $count];
    }
}
