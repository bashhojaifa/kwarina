<?php

namespace App\Http\Controllers\User;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavePostsController extends Controller
{
    public function likePost()
    {
        $authors = User::all();
        $posts = Post::paginate(9);
        $likes = Auth::user()->likes()->latest()->get();
        return view('user.like-posts', compact('posts', 'likes', 'authors'));
    }

    public function commentPost()
    {
        $authors = User::all();
        $posts = Post::all();
        $comments = Auth::user()->comments()->latest()->paginate(9);
        return view('user.comment-posts', compact('posts', 'comments','authors'));
    }
}
