<?php

namespace App\Http\Controllers;

use App\Book;
use App\Carousel;
use App\Home;
use App\Notification;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $images = Carousel::published()->latest()->get();
        $contents = Home::latest()->get();
        $posts = Post::latest()->approved()->get();
        $notifications = Notification::latest()->get();
        return view('home', compact('images', 'contents', 'notifications', 'posts'));
    }
}
