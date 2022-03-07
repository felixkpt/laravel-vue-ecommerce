<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('category')->get();
//        var_dump($products);die;
        return Inertia::render('Admin/Product', ['products' => $products]);
    }
    public function delete($id) {
        Product::where('id', $id)->delete();
        return redirect()->back()->with('successMessage', 'Product deleted.');
    }

}
