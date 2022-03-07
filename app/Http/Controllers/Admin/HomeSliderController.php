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
        return Inertia::render('Admin/HomeSlider', ['home_sliders' => $home_sliders]);
    }
    public function delete($id) {
        HomeSlider::where('id', $id)->delete();
        return redirect()->back()->with('successMessage', 'Home Slider deleted.');
    }

}
