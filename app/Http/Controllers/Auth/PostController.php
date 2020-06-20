<?php

namespace App\Http\Controllers\Auth;

use App\Book;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Like;
use App\Notification;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->approved()->paginate(6);
        $notifications = Notification::latest()->get();
        $books = Book::latest()->published()->get();
        return view('auth.post', compact('posts','notifications', 'books'));
    }


    public function details($slug)
    {
//        $post = Post::find($id);
        $post = Post::where('slug', $slug)->approved()->first();

        //  Author post
        $authorId = $post->user_id;
        $authorPost = Post::approved()->take(5)->inRandomOrder()->where('user_id', $authorId)->get();
        //  End Author post

        //  All Post as randomly
        $randomposts = Post::approved()->take(5)->inRandomOrder()->get();
        //  End All Post as randomly

        //  view count
        $blogKey = 'blog_' . $post->id;
        if (!Session::has($blogKey)){
            $post->increment('view_count');
            Session::put($blogKey, 1);
        }

        //  Comment
        $comments = $post->comments()->latest()->get();
        //  End Comment

        return view('auth.details-post', compact('post', 'randomposts', 'comments', 'authorPost'));
    }


    public function authorPost($id)
    {
        $user = User::find($id);
        $posts = $user->posts()->approved()->get();
        return view('auth.user-post', compact('posts'));
    }

}
