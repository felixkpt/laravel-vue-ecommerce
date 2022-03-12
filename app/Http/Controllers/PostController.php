<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::all();
        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['posts' => $posts, 'title' => $title, 'description' => $description,];
        return Inertia::render('Posts/Index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return Inertia::render('Posts/Show', ['post' => $post]);
    }

}
