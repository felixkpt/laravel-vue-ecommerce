<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $orderby = 'default';
    protected $perPage = 12;
    protected $min_price = 1;
    protected $max_price = 1000;
    public function products() {
        $products = Product::where([['regular_price', '>=', $this->min_price], ['regular_price', '<=', $this->max_price]]);
        if ($this->orderby == 'date') {
            $products = $products->orderby('created_at', 'DESC');
        }elseif ($this->orderby == 'price') {
            $products = $products->orderby('regular_price', 'ASC');
        }elseif ($this->orderby == 'price-desc') {
            $products = $products->orderby('regular_price', 'DESC');
        }
    
        $products = $products->paginate($this->perPage);
        // dd($products);
    
        return $products;
    }
//sitejaba trustpilot
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request) {

        if ($request->get('orderby')) {
            $this->orderby = $request->get('orderby');
        }
        if ($request->get('perPage')) {
            $this->perPage = $request->get('perPage');
        }
        if ($request->get('min_price')) {
            $this->min_price = $request->get('min_price');
        }
        if ($request->get('max_price')) {
            $this->max_price = $request->get('max_price');
        }
        
        $sortings = ['perPage' => $this->perPage, 'orderby' => $this->orderby];
        
        $products = $this->products();
        
        $categories = Category::all();
        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['products' => $products, 'categories' => $categories, 'title' => $title, 'description' => $description,];
        $data = array_merge($data, $sortings);
        // dd($data);
        return response()->json($data);
    }

    function popular() {
        $popular = Product::latest()->limit(5)->get();
        return response()->json($popular);
    }

    public function orderby(Request $request) {
        if ($request->get('get') != 'true') {
            session(['orderby' => $request->get('orderby')]);
        }
        $this->mount();
        return response(['orderby' => $this->orderby], 201);
    }   
    public function perPage(Request $request) {
        if ($request->get('get') != 'true') {
            session(['perPage' => (int) $request->get('perPage')]);
        }
        $this->mount();
        return response(['perPage' => $this->perPage], 201);
    }

    public function priceSort(Request $request) {
        if ($request->get('get') != 'true') {
            session(['min_price' => (int) $request->get('min_price'), 'max_price' => (int) $request->get('max_price')]);
        }
        $this->mount();
       return response(['min_price' => $this->min_price, 'max_price' => $this->max_price], 201);
    }
    
    public function viewType(Request $request) {
        if ($request->get('get') != 'true') {
            session(['viewType' => $request->get('viewType')]);
        }

        $this->mount();
       return response(['viewType' => $this->viewType], 201);
    }
}
