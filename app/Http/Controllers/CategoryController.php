<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Cart;
use App\Models\Product;

class CategoryController extends Controller
{
    protected $orderby;
    protected $postPerPage;
//sitejaba trustpilot
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index($slug, Request $request) {
        $category = Category::where('slug', $slug)->first();
        $products = $this->products($category->id);
        return Inertia::render('Category', ['category' => $category, 'products' => $products]);
    }
    public function store(Request $request) {
        $category_id = $request->get('id');
        $category_name = $request->get('name');
        $quantity = 1;
        $category_price = $request->get('price');
        // var_dump($category_id, $category_name, $quantity, $category_price);die;
        Cart::add($category_id, $category_name, $quantity, $category_price)->associate('App\Models\Product');
        session()->flash('successMessage', 'Item added in Cart');
        // var_dump(Cart::content()[0]);die;
        return redirect()->route('product.cart');
    }

    public function products($category_id) {
        $this->orderby = session()->get('orderby');
        $this->postPerPage = session()->get('postPerPage');

        if ($this->orderby == 'date') {
            $products = Product::where('category_id', $category_id)->orderby('created_at', 'DESC')->limit($this->postPerPage)->get();
        }elseif ($this->orderby == 'price') {
            $products = Product::where('category_id', $category_id)->orderby('regular_price', 'ASC')->limit($this->postPerPage)->get();
        }elseif ($this->orderby == 'price-desc') {
            $products = Product::where('category_id', $category_id)->orderby('regular_price', 'DESC')->limit($this->postPerPage)->get();
        }else{
            $products = Product::where('category_id', $category_id)->limit($this->postPerPage)->get();
        }

        return $products;
    }
}
