<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Cart;
use App\Models\Product;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request){

        $reload = false;
        $cart_data = $this->cart();
        $products = Product::where('id', '>', 0)->limit(10)->get();
        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['cart_data' => $cart_data, 'most_viewed' => $products, 'reload' => $reload, 'title' => $title, 'description' => $description,];
    //  dd($cart_data->count);
        return Inertia::render('Cart', $data);
    }
    
    public function cart() {
        $cart = json_decode(Cart::content());
        $subtotal = Cart::subtotal();
        $tax = Cart::tax();
        $total = Cart::total();
        $count = Cart::count();
        return ['cart' => $cart, 'subtotal' => $subtotal, 'tax' => $tax, 'total' => $total, 'count' => $count];
    }

    public function increaseQuantity(Request $request) {
            $rowId = $request->post('rowId');
            $rowId = trim($rowId, 'id_');
            $product = Cart::get($rowId);
            $qty = $product->qty + 1;
            Cart::update($rowId, $qty);

            $cart_data = $this->cart();
            $data = ['successMessage' => 'Cart quantity updated.', 'cart_data' => $cart_data];

            return response(['cart_data' => $cart_data]);
        }

    public function decreaseQuantity(Request $request) {
        $rowId = $request->post('rowId');
        $rowId = trim($rowId, 'id_');
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        $qty = $qty > 0 ? $qty : 1;
        Cart::update($rowId, $qty);
        
        $cart_data = $this->cart();
        $data = ['successMessage' => 'Cart quantity updated.', 'cart_data' => $cart_data];

        return response(['cart_data' => $cart_data]);
    }

    public function json(){
        return response(['cart_data' => $this->cart()]);
    }

    public function remove(Request $request) {
        $rowId = $request->post('rowId');
        $rowId = (string) ltrim($rowId, 'id_');
        Cart::remove($rowId);
    
        return response(['cart_data' => $this->cart()]);
    }

    public function destroy() {
        Cart::destroy();
        $msg = ['successMessage' => 'Cart has been emptied.'];
        return redirect()->route('shop')->with($msg);

    }
}
