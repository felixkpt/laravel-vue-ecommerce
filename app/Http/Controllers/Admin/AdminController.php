<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(){
        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['title' => $title, 'description' => $description,];
       
        return Inertia::render('Admin/Index', $data);
    }
}
