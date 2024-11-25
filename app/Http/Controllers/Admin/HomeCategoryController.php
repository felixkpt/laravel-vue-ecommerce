<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomeCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeCategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        $home_categories = HomeCategory::first();
        $sel_categories = @explode(',', $home_categories->categories);
        $no_of_products = @$home_categories->no_of_products;

        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['categories' => $categories, 'sel_categories' => $sel_categories, 'no_of_products' => $no_of_products, 'title' => $title, 'description' => $description,];
    
        return Inertia::render('Admin/HomeCategory', $data);
    }
    public function store(Request $request) {

        $data = [
            'categories' => implode(',', $request->get('categories')),
            'no_of_products' => (int) $request->get('no_of_products')
        ];

//        Update or Insert
        $exists = HomeCategory::find(1);
        if ($exists) {
            HomeCategory::where('id', 1)->update($data);
        }else{
            HomeCategory::create($data);
        }
        return redirect()->back()->with('successMessage', 'Home Categories updated.');
    }
}
