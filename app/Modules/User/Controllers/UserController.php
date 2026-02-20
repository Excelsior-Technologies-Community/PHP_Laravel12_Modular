<?php

namespace Modules\User\Controllers;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = ['Alice', 'Bob', 'Charlie'];
        return view('user.index', compact('users'));
    }
}