<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
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
        $posts = Auth::user()->posts()->latest()->get();
        return view('author.post.index', compact('posts'));
    }

    function make_slug($string, $separator = '-')
    {
        $string = trim($string);
        $string = preg_replace('/\s+/u', '-', $string);
        $string = mb_strtolower($string, 'UTF-8');
        $string = preg_replace("/[^a-z0-9_\-\sءاآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهی]/u", '', $string);
        $string = preg_replace("/[\s\-_]+/", ' ', $string);
        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $post->is_approved = false;
        $post->save();
        Toastr::success('Post saved successfully', 'Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
//        Permission check
        if ($post->user_id != Auth::id())
        {
            return redirect()->back();
        }

//        Send to view
        return view('author.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
//        Permission check
        if ($post->user_id != Auth::id())
        {
            return redirect()->back();
        }

//        send to view

        return view('author.post.edit', compact('post'));
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
//        Permission check
        if ($post->user_id != Auth::id())
        {
            return redirect()->back();
        }

//        Validation check

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

//        saved database
        $post->title = $request->title;
        $post->slug = $this->make_slug($request->title);
        $post->body = $request->body;
        $post->is_approved = false;
        $post->save();

        Toastr::success('Post updated successfully', 'Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
//        Permission check
        if ($post->user_id != Auth::id())
        {
            return redirect()->back();
        }

//        Author post delete
        $post->delete();
        Toastr::success('Post Deleted Successfully');
        return redirect()->back();
    }
}
