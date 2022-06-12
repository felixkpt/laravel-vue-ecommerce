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

    private $max_words_des = 100;
    private $max_words = 1000;

    public function index() {

        $categories = Category::all();

        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['categories' => $categories, 'title' => $title, 'description' => $description,];
        
        return Inertia::render('Admin/AddProduct', $data);
    }
    public function  store(Request $request) {

        $slug = $this->generateSlug($request->get('slug') ?: $request->get('name'));
        $request->merge(['slug' => $slug]);

        $rules = [
            'name' => 'required|min:3|max:100|unique:products,name',
            'slug' => 'required|min:3|max:120|unique:products,slug',
            'short_description' => ['required', 'string', 
                function ($attribute, $value, $fail) { if (str_word_count($value) <= 1) { $fail(ucfirst($attribute).' is less than 1 word'); }},
                function ($attribute, $value, $fail) { if (str_word_count($value) >= $this->max_words_des) { $fail(ucfirst($attribute).' is more than '.$this->max_words_des.' words'); }},
            ],
            'description' => ['required', 'string', 
                function ($attribute, $value, $fail) { if (str_word_count($value) <= 1) { $fail(ucfirst($attribute).' is less than 1 word'); }},
                function ($attribute, $value, $fail) { if (str_word_count($value) >= $this->max_words) { $fail(ucfirst($attribute).' is more than '.$this->max_words.' words'); }},
            ],
            'regular_price' => 'required|min:1',
            'sale_price' => 'nullable|number',
            'SKU' => 'required|min:1',
            'stock_status' => 'required',
            'quantity' => 'required|min:1',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
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
            $data = array_merge($data, ['image' => asset('uploads/'.$image_name)]);
        }

        // var_dump($data);die;
        
        Product::create($data);
        return redirect()->route('admin.products')->with('successMessage', 'Added Product.');

    }
    public function generateSlug($str): string {
        return Str::slug($str);
    }

}
