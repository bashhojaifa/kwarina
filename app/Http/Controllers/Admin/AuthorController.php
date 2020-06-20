<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = User::authors()->get();
        return view('admin.author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.author.create');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
            'image' => ['image'],
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //  create profile folder
            if (!Storage::disk('public')->exists('profile')){
                Storage::disk('public')->makeDirectory('profile');
            }

            //  resize image
            $profile = Image::make($image)->resize(100, 100)->save();

            //  put image in folder
            Storage::disk('public')->put('profile/' .$imageName, $profile);
        } else {
            $imageName = 'default.png';
        }

        $author = new User();
        $author->role_id = 2;
        $author->reference_id = Auth::id();
        $author->name = $request->name;
        $author->email = $request->email;
        $author->password = Hash::make($request->password);
        $author->image = $imageName;
        $author->save();


        Toastr::success('Author create successfully', 'Success');
        return redirect()->route('admin.author.index');

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
        $author = User::find($id);
        return view('admin.author.edit', compact('author'));
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
            'name' => 'required',
            'email' => 'required | email',
            'password' => 'confirmed',
            'image' => 'image',
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);
        $author = User::find($id);

        if (isset($image)){
            $currentDate = Carbon::now()->toDateTimeLocalString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //  Create profile folder
            if (!Storage::disk('public')->exists('profile')){
                Storage::disk('public')->makeDirectory('profile');
            }

            //  Delete old profile image
            if (Storage::disk('public')->exists('profile/' .$author->image)){
                Storage::disk('public')->delete('profile/' .$author->image);
            }

            //  Resize image
            $profile = Image::make($image)->resize(100,100)->save();

            //  Put image in folder
            Storage::disk('public')->put('profile/' .$imageName, $profile);
        } else {
            $imageName = $author->image;
        }

        $author->name = $request->name;
        $author->email = $request->email;

        if (isset($request->password)) {
            $author->password = Hash::make($request->password);
        }

        $author->image = $imageName;
        $author->save();
        Toastr::success('Author Updated Successfully', 'Success');
        return redirect()->route('admin.author.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = User::find($id);
        $users = User::where('reference_id', $author->id)->get();

        //  Delete User
        foreach ($users as $user){
            if (Storage::disk('public')->exists('profile/' ,$user->image))
            {
                Storage::disk('public')->delete('profile/' .$user->image);
            }
            $user->delete();
        }

        //  Delete Author profile image
        if (Storage::disk('public')->exists('profile/' .$author->image))
        {
            Storage::disk('public')->delete('profile/' .$author->image);
        }

        $author->delete();
        Toastr::success('Author deleted successfully', 'Success');
        return redirect()->back();
    }
}
