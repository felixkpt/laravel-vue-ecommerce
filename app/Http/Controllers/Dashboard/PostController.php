<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Support\Str;

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
        Inertia::share('url', url('/'));
        $data = ['title' => 'All posts', 'posts' => $posts];
        return Inertia::render('Dashboard/Posts/Index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = ['title' => 'Create a new post'];
        return Inertia::render('Dashboard/Posts/Create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts',
            'content' => 'required',
        ]);

        $data = ['title' => $request->get('title'),
            'slug' => Str::slug($request->get('title')),
            'content' => $request->get('content'),
            'user_id' => 1,
            'published' => true];

        Post::create($data);

        return redirect()->route('posts.index')->with('successMessage', 'Added post successfully.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $data = ['title' => 'Update post', 'post' => $post];
        return Inertia::render('Dashboard/Posts/Edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|unique:posts,title,'.$post->id,
            'content' => 'required'
        ]);

            $data = ['title' => $request->get('title'),
                'slug' => Str::slug($request->get('title')),
                'content' => $request->get('content')];
            $post->update($data);

            return redirect()->route('posts.index')->with('successMessage', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('danger', 'Post Deleted.');
    }
}
