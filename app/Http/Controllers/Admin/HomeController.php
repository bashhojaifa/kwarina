<?php

namespace App\Http\Controllers\Admin;

use App\Home;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Home::latest()->get();
        return view('admin.home.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.home.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'body' => 'required'
        ]);

        $content = new Home();
        if (isset($request->title)){
            $content->title = $request->title;
        } else {
            $content->title = null;
        }

        $content->body = $request->body;
        $content->save();

        Toastr::success('Content save Successfully', 'Success');
        return redirect()->route('admin.home-content.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = Home::find($id);
        return view('admin.home.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $content = Home::find($id);
        if (isset($request->title)) {
            $content->title = $request->title;
        } else {
            $content->title = null;
        }
        $content->body = $request->body;
        $content->update();

        Toastr::success('Content Updated Successfully', 'Success');
        return redirect()->route('admin.home-content.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Home::find($id)->delete();

        Toastr::success('Content Delete Successfully', 'Success');
        return redirect()->back();
    }
}
