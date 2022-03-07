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
    public function index(){

        $data = $this->cart();
        $products = Product::where('id', '>', 0)->limit(10)->get();
       
//var_dump($tax);die;
        return Inertia::render('Cart', ['cart' => $data, 'most_viewed' => $products]);
    }
    public function cart() {
        $cart = json_decode(Cart::content());
        $subtotal = Cart::subtotal();
        $tax = Cart::tax();
        $total = Cart::total();
        $count = Cart::count();
        return ['cart' => $cart, 'subtotal' => $subtotal, 'tax' => $tax, 'total' => $total, 'count' => $count];
    }

    public function json(){
        return json_encode($this->cart());
    }

    public function increaseQuantity(Request $request) {
            $rowId = $request->post('rowId');
            $rowId = trim($rowId, 'id_');
            $product = Cart::get($rowId);
            $qty = $product->qty + 1;
            Cart::update($rowId, $qty);
            $msg = ['successMessage' => 'Cart quantity updated.', 'qty' => $qty];
            return json_encode($msg);
    }

    public function decreaseQuantity(Request $request) {
        $rowId = $request->post('rowId');
        $rowId = trim($rowId, 'id_');
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        $qty = $qty > 0 ? $qty : 1;
        Cart::update($rowId, $qty);
        $msg = ['successMessage' => 'Cart quantity updated.', 'qty' => $qty];
        return json_encode($msg);

    }

    public function remove(Request $request) {
        $rowId = $request->post('rowId');
        $rowId = trim($rowId, 'id_');
        Cart::remove($rowId);
        $msg = ['successMessage' => 'Cart item deleted.'];
        return redirect()->route('product.cart')->with($msg);

    }
    public function destroy() {
        Cart::destroy();
        $msg = ['successMessage' => 'Cart has been emptied.'];
        return redirect()->route('shop')->with($msg);

    }
}
