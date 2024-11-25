<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Cart;
use App\Models\Product;

class CategoryController extends Controller
{
    protected $orderby = 'default';
    protected $perPage = 12;
    protected $min_price = 1;
    protected $max_price = 1000;
    protected $viewType = 'grid';
    public function mount()
    {
        $this->orderby = session()->get('orderby') ?? $this->orderby;
        $this->perPage = session()->get('perPage') ?? $this->perPage;
        $this->min_price = session()->get('min_price') ?? $this->min_price;
        $this->max_price = session()->get('max_price') ?? $this->max_price;
        $this->viewType = session()->get('viewType') ?? $this->viewType;
    }
    //sitejaba trustpilot
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index($slug)
    {
        $this->mount();
        $sortings = ['perPage' => $this->perPage, 'orderby' => $this->orderby, 'viewType' => $this->viewType];

        $category = Category::where('slug', $slug)->first();
        $products = $this->products($category->id);
        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['category' => $category, 'products' => $products, 'title' => $title, 'description' => $description,];
        $data = array_merge($data, $sortings);
        return Inertia::render('Category', $data);
    }
    public function store(Request $request)
    {
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

    public function products($category_id)
    {
        $this->mount();
        $products = Product::where('category_id', $category_id)->where([['regular_price', '>=', $this->min_price], ['regular_price', '<=', $this->max_price]]);
        if ($this->orderby == 'date') {
            $products = $products->orderby('created_at', 'DESC');
        } elseif ($this->orderby == 'price') {
            $products = $products->orderby('regular_price', 'ASC');
        } elseif ($this->orderby == 'price-desc') {
            $products = $products->orderby('regular_price', 'DESC');
        }

        $products = $products->paginate($this->perPage);
        // dd($products);

        return $products;
    }

    function list()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
}
