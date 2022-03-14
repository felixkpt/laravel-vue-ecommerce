<?php

namespace App\Http\Controllers;

use App\Models\HomeCategory;
use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\HomeProduct;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request) {

        $products = HomeProduct::where('id', 1)->first();
        $prods = @explode(',', $products->products);
        $no_of_products_limit = @$products->no_of_products <= 3 ? $products->no_of_products : 3;
        $home_sliders = Product::whereIn('id', $prods)->limit($no_of_products_limit)->get()->toArray();
        
        $latest_products = Product::orderBy('created_at', 'DESC')->limit(14)->get();
        $category = HomeCategory::where('id', 1)->first();
        $cats = @explode(',', $category->categories);
        $no_of_products_limit = @$category->no_of_products;
        $categories = Category::whereIn('id', $cats)->with('products')->get()->toArray();
        $on_sale_time = Sale::find(1);
       
        $new_categories = [];
       foreach ($categories as $category) {
               $products = $category['products'];
              $limit = $no_of_products_limit;
               $products = array_slice($products, 0, $limit > 0 ? $limit : 1);
               
               unset($category['products']);
               $category['products'] = $products;

               $new_categories[] = array_merge($category);

       }
       $categories = $new_categories;
       
       
        $on_sale = Product::where('sale_price', '>', 0)->inRandomOrder()->limit(8)->get();
    //    var_dump($on_sale);die;

        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['home_sliders' => $home_sliders,
        'latest_products' => $latest_products,
        'categories' => $categories,
        'on_sale' => $on_sale,
        'on_sale_time' => $on_sale_time,
         'title' => $title, 'description' => $description,];

        return Inertia::render('Home', $data);
    }
}
