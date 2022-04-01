<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
     public function show(User $user)
    {
        return view('admin.users.show', ["user" => $user]);
    }
}
