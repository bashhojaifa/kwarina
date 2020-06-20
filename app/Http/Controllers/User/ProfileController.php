<?php

namespace App\Http\Controllers\User;

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

class ProfileController extends Controller
{
    public function profile()
    {
        $authors = User::authors()->get();
        return view('user.profile', compact('authors'));
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required | email',
            'image' => 'image',
        ]);

        $slug = Str::slug($request->name);
        $image = $request->file('image');
        $user = User::findOrFail(Auth::id());

        if (isset($image)){
            $currentDate = Carbon::now()->toDateTimeLocalString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('profile/user'))
            {
                Storage::disk('public')->makeDirectory('profile/user');
            }

            //  Delete Old image
            if (Storage::disk('public')->exists('profile/user/' .$user->image))
            {
                Storage::disk('public')->delete('profile/user/' .$user->image);
            }

            //  Resize image
            $profile = Image::make($image)->resize(128 , 128)->save();

            //  Put image in profile folder
            Storage::disk('public')->put('profile/user/' .$imageName, $profile);
        } else {
            $imageName = $user->image;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->save();
        Toastr::success('Profile update successfully', 'Success');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required | confirmed',
        ]);

        $hashPassword = Auth::user()->password;

        if (Hash::check($request->old_password, $hashPassword))
        {
            if (!Hash::check($request->password, $hashPassword)){
                $user = User::findOrFail(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Password Successfully Changed', 'Success');
                Auth::logout();
                return redirect()->back();
            } else {
                Toastr::error('New Password can not be same as old password', 'Error');
                return redirect()->back();
            }
        } else {
            Toastr::error('Current Password not match', 'Error');
            return redirect()->back();
        }
    }
}
