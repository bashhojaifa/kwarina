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

class RegistrationController extends Controller
{
    public function registerForm()
    {
        if (User::admins()->count() == 0){
            return view('admin.registration');
        }else {
            return abort(404);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
            'image' => ['required', 'image'],
        ]);

        $image = $request->file('image');
//        return $image;
        $slug = Str::slug($request->name);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

//            create profile folder
            if (!Storage::disk('public')->exists('profile')){
                Storage::disk('public')->makeDirectory('profile');
            }

//            resize image
            $profile = Image::make($image)->resize(500, 500)->save();
//            put image in folder
            Storage::disk('public')->put('profile/' .$imageName, $profile);
        } else {
            $imageName = 'default.png';
        }

        $author = new User();
        $author->role_id = 1;
        $author->reference_id = 0;
        $author->name = $request->name;
        $author->email = $request->email;
        $author->password = Hash::make($request->password);
        $author->image = $imageName;
        $author->save();

        Toastr::success('Admin create successfully', 'Success');
        return redirect()->route('login');
    }

}
