<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notification;
use App\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // exicution time unlimited
        set_time_limit(0);

        //
        ignore_user_abort();
        $notifications = Notification::all();
        $posts = Post::latest()->get();
        return view('admin.post.index', compact('posts', 'notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    function make_slug($string, $separator = '-')
    {
        $string = preg_replace('/\s+/u', '-', trim($string));

        $string = trim($string);
        $string = mb_strtolower($string, 'UTF-8');
        $string = preg_replace("/[^a-z0-9_\-\sءاآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهی]/u", '', $string);
        $string = preg_replace("/[\s\-_]+/", ' ', $string);
        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $this->make_slug($request->title);
        $post->body = $request->body;
        $post->is_approved = true;
        $post->save();

        if (isset($request->status)) {
            $notification = new Notification();
            $notification->post_status = true;
            $notification->notification = $request->title;
            $notification->status = true;
            $notification->save();
            Toastr::success('Add as Notification', 'Success');
        }

        Toastr::success('Post save successfully', 'Success');
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $notifications = Notification::where('notification', $post->title)->first();
        return view('admin.post.edit', compact('post', 'notifications'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        //  Exist Notificaton update
        $notification = Notification::where('notification', $post->title)->first();
        if ($notification == true){
            if (isset($request->status)){
                $notification->status = true;
            } else {
                $notification->status = false;
            }
            $notification->notification = $request->title;
            $notification->update();
            Toastr::success('Updated Notification', 'Success');
        } else {

            //  create new notification
            if (isset($request->status)) {
                $notification = new Notification();
                $notification->post_status = true;
                $notification->notification = $request->title;
                $notification->status = true;
                $notification->save();
                Toastr::success('Add as Notification', 'Success');
            }
        }

        //  update post
        $post->title = $request->title;
        $post->slug = $this->make_slug($request->title);
        $post->body = $request->body;
        $post->update();

        Toastr::success('Post updated successfully', 'Success');
        return redirect()->route('admin.post.index');
    }

    public function pending()
    {
        $posts = Post::nonApproved()->get();
        return view('admin.post.pending', compact('posts'));
    }


    //  Author Post Approve
    public function approve($id)
    {
        $post = Post::find($id);
        if ($post->is_approved == false) {
            $post->is_approved = true;
            $post->update();

            Toastr::success('Post successfully approve', 'Success');
        } else {
            Toastr::info('Post already approved', 'Info');
        }
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //  Delete Notification
        $notification = Notification::where('notification', $post->title)->first();
        if ($notification == true){
            $notification->delete();
            Toastr::success('Notification deleted Successfully', 'Success');
        }

        // Delete Post
        $post->delete();
        Toastr::success('Post deleted Successfully', 'Success');
        return redirect()->back();
    }
}
