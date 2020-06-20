<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notification;
use App\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::latest()->get();
        return view('admin.notification.notification', compact('notifications'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notification.create');
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
            'notification' => 'required'
        ]);

        $notification = new Notification();

        $posts = Post::all();
        foreach ($posts as $post) {
            if ($post->title == $request->notification){
                $notification->post_status = true;
            } else {
                $notification->post_status = false;
            }
        }

        $notification->notification = $request->notification;

        if (isset($request->status))
        {
            $notification->status = true;
        } else {
            $notification->status = false;
        }

        $notification->save();
        Toastr::success('Notification saved successfully :)', 'Success');
        return redirect()->route('admin.notification.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {

        return view('admin.notification.edit', compact('notification'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        $this->validate($request, [
            'notification' => 'required'
        ]);

        $posts = Post::all();
        foreach ($posts as $post) {
            if ($post->title == $request->notification){
                $notification->post_status = true;
            } else {
                $notification->post_status = false;
            }
        }

        $notification->notification = $request->notification;

        if (isset($request->status))
        {
            $notification->status = true;
        } else {
            $notification->status = false;
        }

        $notification->update();
        Toastr::success('Notification updated successfully', 'Success');
        return redirect()->route('admin.notification.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();
        Toastr::success('Notification delete successfully', 'Success');
        return redirect()->back();
    }
}
