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

class SettingsController extends Controller
{
    public function profileform()
    {
        return view('admin.profile.update-profile');
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required | email',
            'image' => 'image'
        ]);

        $user = User::findOrFail(Auth::id());
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if (isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //  create profile folder
            if (!Storage::disk('public')->exists('profile')){
                Storage::disk('public')->makeDirectory('profile');
            }

            //   Delete old image
            if (Storage::disk('public')->exists('profile/' .$user->image)){
                Storage::disk('public')->delete('profile/' .$user->image);
            }
            //  resize image
            $profile = Image::make($image)->resize(100, 100)->save();
            Storage::disk('public')->put('profile/' .$imageName, $profile);
        } else {
            $imageName = $user->image;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->save();
        Toastr::success('Profile saved successfully');
        return redirect()->back();
    }

    public function passwordForm()
    {
        return view('admin.profile.change-password');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required | confirmed'
        ]);

        $hashPassword = Auth::user()->password;

        if (Hash::check($request->old_password, $hashPassword)){
            if (!Hash::check($request->password, $hashPassword)){
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();

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
