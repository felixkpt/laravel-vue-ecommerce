<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\HomeProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeSliderController extends Controller
{
    public function index() {
        $product = HomeProduct::where('id', 1)->first();
        $prods = @explode(',', $product->products);
        $no_of_products_limit = @$product->no_of_products;
        $products = Product::whereIn('id', $prods)->get();
        
        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['products' => $products, 'title' => $title, 'description' => $description,];
    
        return Inertia::render('Admin/HomeSlider', $data);
    }
    public function delete($id) {
        HomeSlider::where('id', $id)->delete();
        return redirect()->back()->with('successMessage', 'Home Slider deleted.');
    }

}
