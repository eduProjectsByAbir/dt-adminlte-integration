<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;


class AdminProfileController extends Controller
{

    public function index()
    {
        return view('admin.profile.profile-view');
    }


    public function edit(User $profile)
    {
        $user = $profile;
        return view('admin.profile.profile-edit')->with('user', $user);
    }

    public function update(Request $request, User $profile)
    {
        if ($profile->id === Auth::user()->id) {
            $request->validate([
                'name' => 'required|string|min:2|max:35',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
            ]);
            // updating profile
            $profile->name = $request->name;
            $profile->email = $request->email;

            // Validate image if want to profile image
            if ($request->hasFile('dpicture')) {
                $request->validate([
                    'dpicture' =>  'image|mimes:jpeg,png,jpg,gif'
                ]);

                $oldPicture = $profile->dpicture;
                if (file_exists($oldPicture) && $oldPicture != 'backend/admin/images/default.png') {
                    // unlink old image
                    unlink($oldPicture);
                }
                // save file to host
                $dpicture = $request->dpicture->move('backend/uploads/', $request->dpicture->hashName());

                //change picture
                $profile->dpicture = $dpicture;
            }
            //if user want to change password
            if ($request->change_password === 1) {
                $request->validate([
                    'current_password' => 'required',
                    'password'  => 'required|min:6',
                    'password_confirmation' => 'required|min:6|same:password'
                ]);

                // checking if current password is correct and both password are not same
                $currentPass = Auth::User()->password;

                if (!Hash::check($request->current_password, $currentPass)) {
                    Toastr::error('current password not match with your old password!', 'Password Error!', ["positionClass" => "toast-top-center"]);
                    return redirect()->back();
                } elseif (Hash::check($request->password, $currentPass)) {
                    Toastr::error('Opps! You entered same password!', 'Password Error!', ["positionClass" => "toast-top-center"]);
                    return redirect()->back();
                } else {
                    // updating password
                    $profile->password = Hash::make($request->password);
                }
            }
        }

        $profile->save();

        Toastr::success('WOW! Your profile updated successfully!', 'Update Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('profile.index');
    }
}
