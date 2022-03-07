<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AddCategoryController extends Controller
{
    public function index() {

        return Inertia::render('Admin/AddCategory', []);
    }
    public function  store(Request $request) {

        $slug = $this->generateSlug($request->get('slug') ?: $request->get('name'));
        $request->merge(['slug' => $slug]);

        $rules = [
            'name' => 'required|min:3|max:30|unique:categories,name',
            'slug' => 'required|min:3|max:40|unique:categories,slug',
        ];

        $this->validate($request, $rules);

        $data = ['name' => $request->get('name'),
            'slug' => $request->get('slug'),
        ];

//        var_dump($data);die;
        Category::create($data);
        return redirect()->route('admin.categories')->with('successMessage', 'Added category.');

    }
    public function generateSlug($str): string {
        return Str::slug($str);
    }

}
