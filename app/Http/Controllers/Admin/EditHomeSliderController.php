<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EditHomeSliderController extends Controller
{
    public function index(Request $request, $id) {

        $home_slider = HomeSlider::where('id', $id)->first();

        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['home_slider' => $home_slider, 'title' => $title, 'description' => $description,];
     
        return Inertia::render('Admin/EditHomeSlider', $data);
    }

    public function  update(Request $request) {
        $id = $request->get('id');

        $rules = [
            'title' => 'required|min:3|max:30|unique:home_sliders,title,'.$id.',id',
            'subtitle' => 'required|min:3|max:50|unique:home_sliders,subtitle,'.$id.',id',
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
        $category = HomeSlider::where('id', $id)->update($data);
        return redirect()->route('admin.home-sliders')->with('successMessage', 'Updated Home Slider.');

    }
}
