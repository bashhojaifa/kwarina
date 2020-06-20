<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SequenceUsers extends Controller
{
    public function sequence()
    {
        $users = User::all();
        $auths = Auth::id();
        $authorSequence = User::where('reference_id', $auths)->get();
        return view('admin.users-sequence', compact('authorSequence', 'users'));
    }
}
