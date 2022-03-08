<?php

namespace App\Http\Controllers;

use App\Models\HomeCategory;
use App\Models\Category;
use App\Models\HomeSlider;
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

        dd($request);
        $home_sliders = HomeSlider::all();
        $latest_products = Product::orderBy('created_at', 'DESC')->limit(8)->get();
        $category = HomeCategory::where('id', 1)->first();
        $cats = @explode(',', $category->categories);
        $no_of_products_limit = @$category->no_of_products;
        $categories = Category::whereIn('id', $cats)->with('products')->get()->toArray();
        $on_sale_time = Sale::find(1);
       
        $new_categories = [];
       foreach ($categories as $category) {
               $products = $category['products'];
              $limit = $no_of_products_limit - 1;
               $products = array_slice($products, 0, $limit > 0 ? $limit : 1);
               
               unset($category['products']);
               $category['products'] = $products;

               $new_categories[] = array_merge($category, ['products' => $products]);

       }
       $categories = $new_categories;
       
       
        $on_sale = Product::where('sale_price', '>', 0)->inRandomOrder()->limit(8)->get();
//        var_dump(count($on_sale));die;
        return Inertia::render('Home', [
                'home_sliders' => $home_sliders,
                'latest_products' => $latest_products,
                'categories' => $categories,
                'on_sale' => $on_sale,
                'on_sale_time' => $on_sale_time,
//                'canLogin' => Route::has('login'),
//                'canRegister' => Route::has('register'),
            ]);
    }
}
