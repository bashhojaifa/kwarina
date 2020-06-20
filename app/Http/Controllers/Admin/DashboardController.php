<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Carousel;
use App\Http\Controllers\Controller;
use App\Notification;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        //  count all posts
        $all_post = Post::approved()->count();
        //  count pending posts
        $pending_post = Post::nonApproved()->count();
        //  count all author
        $all_author = User::authors()->count();
        //  count all user
        $all_user = User::users()->count();
        //  view top 7 posts
        $popular_posts = Post::withCount('comments')
                            ->withCount('likes')
                            ->orderBy('view_count', 'desc')
                            ->orderBy('comments_count', 'desc')
                            ->orderBy('likes_count', 'desc')
                            ->take(7)->get();
        // End view top 7 posts

        // Admin overview
        $all_view = Post::sum('view_count');
        $likes = Auth::user()->likes()->count();
        $comments = Auth::user()->comments()->count();
        $newNotification = Notification::newNotifications()->count();
        $oldNotification = Notification::oldNotifications()->count();
        $publishedBook = Book::published()->count();
        $publishedCarousel = Carousel::published()->count();
        $nonPublishedCarousel = Carousel::nonpublished()->count();
        //  End Admin Overview

        // View top 5 active author
        $active_authors = User::authors()
                        ->withCount('posts')
                        ->withCount('likes')
                        ->withCount('comments')
                        ->orderBy('posts_count', 'desc')
                        ->orderBy('likes_count', 'desc')
                        ->orderBy('comments_count', 'desc')
                        ->take(5)->get();
        //      End View top 5 active user
        return view('admin.dashboard', compact('all_post', 'pending_post', 'all_author', 'all_user','popular_posts','all_view', 'active_authors', 'likes', 'comments','newNotification', 'oldNotification','publishedBook', 'publishedCarousel', 'nonPublishedCarousel'));
    }
}
