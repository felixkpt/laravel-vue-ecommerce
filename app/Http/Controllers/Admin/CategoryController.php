<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return Inertia::render('Admin/Category', ['categories' => $categories]);
    }
    public function delete($id) {
        Category::where('id', $id)->delete();
        return redirect()->back()->with('successMessage', 'Category deleted.');
    }

}
