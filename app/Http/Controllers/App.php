<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\Route;

class App extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = null)
    {

        $route = Route::current(); // Illuminate\Routing\Route
        $uri = $route->uri;

        $title = 'Welcome to our homepage';
        $body = 'Reach us quickly via our social media pages.';
        if ($uri == 'about') {
            $title = 'About us page';
            $body = 'We are a vast growing online shopping platform.';
        }elseif ($uri == 'contact') {
            $title = 'Contact us page';
            $body = 'Reach us quickly via our social media pages.';
        }

        $data = ['title' => $title, 'body' => $body, 'url' => url('')];

        $view = strlen(ucfirst($uri)) == 1 ? 'App' : ucfirst($uri);
        return Inertia::render('App/'.$view, $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
