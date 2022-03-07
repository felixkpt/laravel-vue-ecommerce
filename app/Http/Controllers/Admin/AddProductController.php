<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AddProductController extends Controller
{
    public function index() {

        $categories = Category::all();

        return Inertia::render('Admin/AddProduct', ['categories' => $categories]);
    }
    public function  store(Request $request) {

        $slug = $this->generateSlug($request->get('slug') ?: $request->get('name'));
        $request->merge(['slug' => $slug]);

        $rules = [
            'name' => 'required|min:3|max:30|unique:products,name',
            'slug' => 'required|min:3|max:50|unique:products,slug',
            'short_description' => 'required|min:10|max:150',
            'description' => 'required|min:10',
            'regular_price' => 'required|min:1',
            'sale_price' => 'required|min:1',
            'SKU' => 'required|min:1',
            'stock_status' => 'required',
            'quantity' => 'required|min:1',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ];

        $this->validate($request, $rules);

        $image_name = 'default.jpg';
        if ($request->hasFile('image')) {
            $image_name = $request->file('image')->store('images/products', 'public');
        }
        $data = [
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'short_description' => $request->get('short_description'),
            'description' => $request->get('description'),
            'regular_price' => $request->get('regular_price'),
            'sale_price' => $request->get('sale_price'),
            'SKU' => $request->get('SKU'),
            'stock_status' => $request->get('stock_status'),
            'quantity' => $request->get('quantity'),
            'image' => $image_name,
            'category_id' => $request->get('category_id'),
        ];

//        var_dump($data);die;
        Product::create($data);
        return redirect()->route('admin.products')->with('successMessage', 'Added Product.');

    }
    public function generateSlug($str): string {
        return Str::slug($str);
    }

}
