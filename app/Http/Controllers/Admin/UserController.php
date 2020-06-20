<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = User::authors()->get();
        $users = User::users()->get();
        return view('admin.user.index', compact('users', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = User::authors()->get();
        return view('admin.user.create', compact('authors'));
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
            'author' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
            'image' => ['image'],
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if (isset($image)){
            $currentDate = Carbon::now()->toDateTimeLocalString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('profile'))
            {
                Storage::disk('public')->makeDirectory('profile');
            }

            //  Resize image
            $profile = Image::make($image)->resize(128 , 128)->save();

            //  Put image in profile folder
            Storage::disk('public')->put('profile/' .$imageName, $profile);
        } else {
            $imageName = 'default.png';
        }

        $user = new User();
        $user->role_id = 3;
        $user->reference_id = $request->author;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->image = $imageName;
        $user->save();
        Toastr::success('User create successfully', 'Success');
        return redirect()->route('admin.user.index');
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

        $user = User::findOrFail($id);
        $authors = User::authors()->get();
        return view('admin.user.edit', compact('user', 'authors'));
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
            'author' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['confirmed'],
            'image' => ['image'],
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);
        $user = User::find($id);

        if (isset($image)){
            $currentDate = Carbon::now()->toDateTimeLocalString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('profile'))
            {
                Storage::disk('public')->makeDirectory('profile');
            }

            //  Delete Old image
            if (Storage::disk('public')->exists('profile/' .$user->image))
            {
                Storage::disk('public')->delete('profile/' .$user->image);
            }

            //  Resize image
            $profile = Image::make($image)->resize(128 , 128)->save();

            //  Put image in profile folder
            Storage::disk('public')->put('profile/' .$imageName, $profile);
        } else {
            $imageName = $user->image;
        }

        $user->reference_id = $request->author;
        $user->name = $request->name;
        $user->email = $request->email;

        if (isset($request->password)){
            $user->password = Hash::make($request->password);
        }

        $user->image = $imageName;
        $user->save();
        Toastr::success('User updated successfully', 'Success');
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        //  Delete profile image
        if (Storage::disk('public')->exists('profile/' .$user->image))
        {
            Storage::disk('public')->delete('profile/' .$user->image);
        }
        $user->delete();
        Toastr::success('User Delete Successfully', 'Success');
        return redirect()->back();
    }

}
