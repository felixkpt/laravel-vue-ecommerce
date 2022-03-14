<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\HomeProduct;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AddHomeSliderController extends Controller
{
    public function index() {
        $products = Product::all();
        $home_products = HomeProduct::first();
        $sel_products = @explode(',', $home_products->products);
        $no_of_products = @$home_products->no_of_products;

        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['products' => $products, 'sel_products' => $sel_products, 'no_of_products' => $no_of_products, 'title' => $title, 'description' => $description,];
    
        return Inertia::render('Admin/AddHomeSlider', $data);
    }
    public function store(Request $request) {

        $data = [
            'products' => implode(',', $request->get('products')),
            'no_of_products' => (int) $request->get('no_of_products')
        ];

//        Update or Insert
        $exists = HomeProduct::find(1);
        if ($exists) {
            HomeProduct::where('id', 1)->update($data);
        }else{
            HomeProduct::create($data);
        }
        return redirect()->route('admin.home-sliders')->with('successMessage', 'Home Products updated.');
    }
}
