<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AddHomeSliderController extends Controller
{
    public function index() {
        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['title' => $title, 'description' => $description,];
        
        return Inertia::render('Admin/AddHomeSlider', $data);
    }
    public function  store(Request $request) {
        $rules = [
            'title' => 'required|min:3|max:30|unique:home_sliders,title',
            'subtitle' => 'required|min:3|max:50|unique:home_sliders,subtitle',
            'price' => 'required|numeric',
            'link' => 'required|url|min:8',
//            'image' => 'image',
        ];

        $this->validate($request, $rules);

        $image_name = 'default.jpg';
        $data = [
            'title' => $request->get('title'),
            'subtitle' => $request->get('subtitle'),
            'price' => $request->get('price'),
            'link' => $request->get('link'),
            'image' => $image_name,
            'status' => $request->get('status'),
        ];

//        var_dump($data);die;
        HomeSlider::create($data);
        return redirect()->route('admin.home-sliders')->with('successMessage', 'Added Home Slider.');

    }


    }
