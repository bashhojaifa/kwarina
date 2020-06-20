<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function authorUsers()
    {
        $auths = Auth::id();
        $users = User::where('reference_id', $auths)->get();

        return view('author.users', compact('users', 'auths'));
    }
}
