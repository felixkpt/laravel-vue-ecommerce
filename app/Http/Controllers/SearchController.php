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
    protected $min_price = 1;
    protected $max_price = 10000;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {

        $categories = Category::all();
        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['products' => $this->list($request), 'categories' => $categories, 'title' => $title, 'description' => $description, 'params' => request()->all()];
        return Inertia::render('Search', $data);
    }

    public function store(Request $request)
    {
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

    public function orderby(Request $request)
    {
        session(['orderby' => $request->get('orderby')]);
        return redirect()->back();
    }

    public function postPerPage(Request $request)
    {
        session(['postPerPage' => $request->get('postPerPage')]);
        return redirect()->back();
    }

    public function list(Request $request)
    {
        $this->orderby = $request->get('orderby');
        $this->postPerPage = $request->get('postPerPage');
        $this->search = $request->get('search');
        $this->product_cat = $request->get('product_cat');
        $this->product_cat_id = $request->get('product_cat_id');
        $this->min_price = $request->get('min_price');
        $this->max_price = $request->get('max_price');

        $products = Product::when($this->min_price > 0, fn($q) => $q->where('regular_price', '>=', $this->min_price))
            ->when($this->max_price > 0, fn($q) => $q->where('regular_price', '<=', $this->max_price));

        if ($this->product_cat_id) {
            if ($this->orderby == 'date') {
                $products = $products->where('name', 'like', '%' . $this->search . '%')->where('category_id', $this->product_cat_id)->orderby('created_at', 'DESC');
            } elseif ($this->orderby == 'price') {
                $products = $products->where('name', 'like', '%' . $this->search . '%')->where('category_id', $this->product_cat_id)->orderby('regular_price', 'ASC');
            } elseif ($this->orderby == 'price-desc') {
                $products = $products->where('name', 'like', '%' . $this->search . '%')->where('category_id', $this->product_cat_id)->orderby('regular_price', 'DESC');
            } else {
                $products = $products->where('name', 'like', '%' . $this->search . '%')->where('category_id', $this->product_cat_id);
            }
        } else {

            if ($this->orderby == 'date') {
                $products = $products->where('name', 'like', '%' . $this->search . '%')->orderby('created_at', 'DESC');
            } elseif ($this->orderby == 'price') {
                $products = $products->where('name', 'like', '%' . $this->search . '%')->orderby('regular_price', 'ASC');
            } elseif ($this->orderby == 'price-desc') {
                $products = $products->where('name', 'like', '%' . $this->search . '%')->orderby('regular_price', 'DESC');
            } else {
                $products = $products->where('name', 'like', '%' . $this->search . '%');
            }
        }

         // Paginate the results and append the query parameters
         $products = $products->paginate($this->postPerPage)
         ->withPath('/search')
         ->appends([
             'orderby' => $this->orderby,
             'postPerPage' => $this->postPerPage,
             'search' => $this->search,
             'product_cat' => $this->product_cat,
             'product_cat_id' => $this->product_cat_id,
             'min_price' => $this->min_price,
             'max_price' => $this->max_price,
         ]);

        return $products;
    }
}
