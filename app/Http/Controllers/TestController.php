<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request) {

        $rules = ['user' => 'required',
            'email' => 'required'];
        $this->validate($request, $rules);

        $user = $request->get('user');
        var_dump($user);
        die;
    }
}
