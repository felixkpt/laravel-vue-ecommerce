<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use Cart;

class ShopController extends Controller
{
    protected $orderby;
    protected $postPerPage;
//sitejaba trustpilot
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request) {
        $page_size = $request->page_size ?? 10;
        $products = $this->products($page_size);
        
        $categories = Category::all();
        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['products' => $products, 'categories' => $categories, 'title' => $title, 'description' => $description,];
        return Inertia::render('Shop', $data);
    }
    public function store(Request $request) {
        $product_id = $request->get('id');
        $product_name = $request->get('name');
        $quantity = $request->get('qty') ?? 1;
        $product_price = $request->get('price');

        // Deleting item from cart if exists
        $asd = Cart::content()->where('id', $product_id);
        $cart_data = 0;
        foreach ($asd as $row) {
        $cart_data = $row;
        }
        if ($cart_data) {
            Cart::remove($cart_data->rowId);
        }

        // var_dump($product_id, $product_name, $quantity, $product_price);die;
        Cart::add($product_id, $product_name, $quantity, $product_price)->associate('App\Models\Product');
        session()->flash('successMessage', 'Item added in Cart');
        // var_dump(Cart::content()[0]);die;
        return redirect()->route('shop.cart');
    }
    public function orderby(Request $request) {
        session(['orderby' => $request->get('orderby')]);
        return redirect()->back();
    }
    public function postPerPage(Request $request) {
        session(['postPerPage' => $request->get('postPerPage')]);
        return redirect()->back();
    }
    public function products($page_size) {
        // $this->orderby = session()->get('orderby');
        $this->postPerPage = session()->get('postPerPage');

        if ($this->orderby == 'date') {
            $products = Product::orderby('created_at', 'DESC')->limit($this->postPerPage)->get();
        }elseif ($this->orderby == 'price') {
            $products = Product::orderby('regular_price', 'ASC')->limit($this->postPerPage)->get();
        }elseif ($this->orderby == 'price-desc') {
            $products = Product::orderby('regular_price', 'DESC')->limit($this->postPerPage)->get();
        }else{
            $products = Product::paginate($page_size);
        }

        return $products;
    }
}
