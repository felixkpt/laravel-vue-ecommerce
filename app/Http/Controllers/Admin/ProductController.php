<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('category')->paginate(30);
        
        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['products' => $products, 'title' => $title, 'description' => $description,];
        
        return Inertia::render('Admin/Product', $data);
    }
    public function delete($id) {
        Product::where('id', $id)->delete();
        return redirect()->back()->with('successMessage', 'Product deleted.');
    }

}
