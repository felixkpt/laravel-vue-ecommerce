<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::orderby('created_at', 'desc')->paginate(30);

        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['users' => $users, 'title' => $title, 'description' => $description,];

        return Inertia::render('Admin/Users', $data);
    }

}
