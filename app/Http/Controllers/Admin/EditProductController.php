<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Product;

class EditProductController extends Controller
{
    public function index(Request $request, $slug) {

        $product = Product::where('slug', $slug)->first();
        $categories = Category::all();

        return Inertia::render('Admin/EditProduct', ['product' => $product, 'categories' => $categories]);
    }
    public function update(Request $request) {

//        dd($request->all());
        $id = $request->get('id');
        $slug = $this->generateSlug($request->get('slug') ?: $request->get('name'));
        $request->merge(['slug' => $slug]);

        $rules = [
            'name' => 'required|min:3|max:30|unique:products,name,'.$id.',id',
            'slug' => 'required|min:3|max:50|unique:products,slug,'.$id.',id',

        ];
        $image_name = 'default.jpg';
        if ($request->hasFile('image')) {
            $rules = array_merge($rules, ['image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048']);
            $image_name = $request->file('image')->store('images/products', 'public');
        }

        $this->validate($request, $rules);


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
            'category_id' => $request->get('category_id'),
        ];
        if ($request->hasFile('image')) {
            $data = array_merge($data, ['image' => $image_name]);
        }

        $Product = Product::where('id', $id)->update($data);
        return redirect()->route('admin.products')->with('successMessage', 'Updated Product.');

    }
    public function generateSlug($str): string {
        return Str::slug($str);
    }
}
