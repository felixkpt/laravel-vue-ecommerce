<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use Cart;

class SearchController extends Controller
{
    protected $orderby;
    protected $postPerPage;
    public $search;
    public $product_cat;
    public $product_cat_id;
//sitejaba trustpilot
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request) {
        $products = $this->products($request);
        $categories = Category::all();
        return Inertia::render('Search', ['products' => $products, 'categories' => $categories]);
    }
    public function store(Request $request) {
        $product_id = $request->get('id');
        $product_name = $request->get('name');
        $quantity = 1;
        $product_price = $request->get('price');
        // var_dump($product_id, $product_name, $quantity, $product_price);die;
        Cart::add($product_id, $product_name, $quantity, $product_price)->associate('App\Models\Product');
        session()->flash('successMessage', 'Item added in Cart');
        // var_dump(Cart::content()[0]);die;
        return redirect()->route('product.cart');
    }
    public function orderby(Request $request) {
        session(['orderby' => $request->get('orderby')]);
        return redirect()->back();
    }
    public function postPerPage(Request $request) {
        session(['postPerPage' => $request->get('postPerPage')]);
        return redirect()->back();
    }
    public function products(Request $request) {
        $this->orderby = session()->get('orderby');
        $this->postPerPage = session()->get('postPerPage');
        $this->search = $request->get('search');
        $this->product_cat = $request->get('product_cat');
        $this->product_cat_id = $request->get('product_cat_id');

        if ($this->product_cat_id) {
            if ($this->orderby == 'date') {
                $products = Product::where('name','like', '%'.$this->search.'%')->where('category_id', $this->product_cat_id)->orderby('created_at', 'DESC')->limit($this->postPerPage)->get();
            }elseif ($this->orderby == 'price') {
                $products = Product::where('name','like', '%'.$this->search.'%')->where('category_id', $this->product_cat_id)->orderby('regular_price', 'ASC')->limit($this->postPerPage)->get();
            }elseif ($this->orderby == 'price-desc') {
                $products = Product::where('name','like', '%'.$this->search.'%')->where('category_id', $this->product_cat_id)->orderby('regular_price', 'DESC')->limit($this->postPerPage)->get();
            }else{
                $products = Product::where('name','like', '%'.$this->search.'%')->where('category_id', $this->product_cat_id)->limit($this->postPerPage)->get();
            }
        }else{

            if ($this->orderby == 'date') {
                $products = Product::where('name','like', '%'.$this->search.'%')->orderby('created_at', 'DESC')->limit($this->postPerPage)->get();
            }elseif ($this->orderby == 'price') {
                $products = Product::where('name','like', '%'.$this->search.'%')->orderby('regular_price', 'ASC')->limit($this->postPerPage)->get();
            }elseif ($this->orderby == 'price-desc') {
                $products = Product::where('name','like', '%'.$this->search.'%')->orderby('regular_price', 'DESC')->limit($this->postPerPage)->get();
            }else{
                $products = Product::where('name','like', '%'.$this->search.'%')->limit($this->postPerPage)->get();
            }
        }

        return $products;
    }
}
