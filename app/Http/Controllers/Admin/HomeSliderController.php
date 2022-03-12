<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeSliderController extends Controller
{
    public function index() {
        $home_sliders = HomeSlider::all();
        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['home_sliders' => $home_sliders, 'title' => $title, 'description' => $description,];
    
        return Inertia::render('Admin/HomeSlider', $data);
    }
    public function delete($id) {
        HomeSlider::where('id', $id)->delete();
        return redirect()->back()->with('successMessage', 'Home Slider deleted.');
    }

}
