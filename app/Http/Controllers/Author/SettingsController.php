<?php

namespace App\Http\Controllers\Author;

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

class SettingsController extends Controller
{
//    send author profile view
    public function profileForm()
    {
        return view('author.profile.update-profile');
    }

//    Update data
    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required | email',
            'image' => 'image'
        ]);

        $author = User::findOrFail(Auth::id());
        $slug = Str::slug($request->name);
        $image = $request->file('image');

        if (isset($image)){
            $currentDate = Carbon::now()->toDateTimeLocalString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

//            create profile folder
            if (!Storage::disk('public')->exists('profile')){
                Storage::disk('public')->makeDirectory('profile/');
            }

//            Delete old image
            if (Storage::disk('public')->exists('profile/' .$author->image)){
                Storage::disk('public')->delete('profile/' .$author->image);
            }

//            Resize profile image
            $profile = Image::make($image)->resize(500, 500)->save();
            Storage::disk('public')->put('profile/' .$imageName, $profile);
        } else {
            $imageName = $author->image;
        }

        $author->name = $request->name;
        $author->email = $request->email;
        $author->image = $imageName;
        $author->save();

        Toastr::success('Profile updated successfully', 'Success');
        return redirect()->back();
    }

//    send password view
    public function passwordForm()
    {
        return view('author.profile.change-password');
    }

//    Update date
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required | confirmed'
        ]);

        $hashPassword = Auth::user()->password;

        if (Hash::check($request->old_password, $hashPassword)){
            if (!Hash::check($request->password, $hashPassword)){
                $author = User::findOrFail(Auth::id());
                $author->password = Hash::make($request->password);
                $author->save();

                Toastr::success('Password change successfully', 'Success');
                Auth::logout();

                return redirect()->back();
            } else {
                Toastr::error('New password can not be same as old password', 'Error');
                return redirect()->back();
            }
        } else {
            Toastr::error('Current password not match', 'Error');
            return redirect()->back();
        }
    }


}
