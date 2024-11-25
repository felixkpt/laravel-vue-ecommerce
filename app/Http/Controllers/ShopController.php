<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShopController extends Controller
{
    protected $orderby = 'default';
    protected $perPage = 12;
    protected $min_price = 1;
    protected $max_price = 10000;
    protected $viewType = 'grid';

    public function mount()
    {
        $this->orderby = session()->get('orderby') ?? $this->orderby;
        $this->perPage = session()->get('perPage') ?? $this->perPage;
        $this->min_price = session()->get('min_price') ?? $this->min_price;
        $this->max_price = session()->get('max_price') ?? $this->max_price;
        $this->viewType = session()->get('viewType') ?? $this->viewType;
        
    }
    
    public function products() {
        $this->mount();
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
        $this->mount();
        
        $sortings = ['perPage' => $this->perPage, 'orderby' => $this->orderby, 'viewType' => $this->viewType];
        // dd($sortings);
        $products = $this->products();
        
        $categories = Category::all();
        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['products' => $products, 'categories' => $categories, 'title' => $title, 'description' => $description,];
        $data = array_merge($data, $sortings);
        // dd($data);
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
    
}
