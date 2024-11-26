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
    protected $category = null;
    public function products($path = null) {
        $products = Product::where([['regular_price', '>=', $this->min_price], ['regular_price', '<=', $this->max_price]]);
        if ($this->category) {
            $products->where('category_id', $this->category);  
        }
        if ($this->orderby == 'date') {
            $products = $products->orderby('created_at', 'DESC');
        }elseif ($this->orderby == 'price') {
            $products = $products->orderby('regular_price', 'ASC');
        }elseif ($this->orderby == 'price-desc') {
            $products = $products->orderby('regular_price', 'DESC');
        }
    
        $products = $products->paginate($this->perPage);
        $products->withPath('');
    
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
        if ($request->get('category')) {
            $this->category = $request->get('category');
        }

        if ($request->get('category')) {
            $cat = Category::where('slug', $this->category)->first();
            if ($cat ) {
                $this->category = $cat->id;
            }  
        }

        $path = null;
        if ($request->get('path')) {
            $path = 'n';
        }
        
        $sortings = ['perPage' => $this->perPage, 'orderby' => $this->orderby];
        
        $products = $this->products($path);
        
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

    
}
