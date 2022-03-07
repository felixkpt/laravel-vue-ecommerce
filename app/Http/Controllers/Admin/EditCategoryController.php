<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Category;

class EditCategoryController extends Controller
{
    public function index(Request $request, $slug) {

        $category = Category::where('slug', $slug)->first();

        return Inertia::render('Admin/EditCategory', ['category' => $category]);
    }
    public function update(Request $request) {

        $id = $request->get('id');
        $slug = $this->generateSlug($request->get('slug') ?: $request->get('name'));
        $request->merge(['slug' => $slug]);

        $rules = [
            'name' => 'required|min:3|max:30|unique:categories,name,'.$id.',id',
            'slug' => 'required|min:3|max:40|unique:categories,slug,'.$id.',id',
        ];

        $this->validate($request, $rules);

        $data = ['name' => $request->get('name'),
            'slug' => $request->get('slug'),
        ];

        $category = Category::where('id', $id)->update($data);
        return redirect()->route('admin.categories')->with('successMessage', 'Updated category.');

    }
    public function generateSlug($str): string {
        return Str::slug($str);
    }
}
