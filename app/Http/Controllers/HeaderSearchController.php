<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HeaderSearchController extends Controller
{
    public function index() {
        $category = Category::all();
        return json_encode($category);
    }
}
