<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{

    public function index()
    {
        return view('admin.profile.profile-view');
    }


    public function edit($id)
    {
        $user = User::FindOrFail(auth()->id());
        return view('admin.profile.profile-edit')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        // Data Validation
        $errors = $request->validate([
            'name' => 'required|string|min:2|max:35',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
        ]);

        // Validate password if want to change
        if ($request->change_password == 1) {
            $this->validate($request, [
                'current_password' => 'required',
                'password'  => 'required|min:6',
                'password_confirmation' => 'required|min:6|same:password'
            ]);
        }

        if ($request->change_password == 1) {
            $hashedpass = Auth::User()->password; // User Old Password
            if (!Hash::check($request->current_password, $hashedpass)) {
                echo "Old password doesnt't matched!";
            }
        }

        // Validate old Password And New Password Are Same
        if ($request->change_password == 1) {
            $hashedpass = Auth::User()->password; // User Old Password

            if (Hash::check($request->password, $hashedpass)) {
                echo "Old password and new passwords are same!";
            }
        }

        // Validate image if want to profile image
        if ($request->dpicture) {
            $request->validate([
                'dpicture' =>  'image|mimes:jpeg,png,jpg,gif'
            ]);
        }

        dd($request);
    }











    public function updates(Request $request)
    {

        // Validate primary data
        $errors =  $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:32'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
        ]);
        // Validate password if want to change
        if ($request->isPasswordChange == 1) {

            $request->validate([
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'current_password' => ['required', 'string', 'min:6'],
            ]);
        }


        // if old password request current password are not same
        if ($request->isPasswordChange == 1) {
            $hashedpass = Auth::User()->password; // User Old Password
            if (!Hash::check($request->current_password, $hashedpass)) {
                return redirect()->back()->with('error', 'current password not match with your old password');
            }
        }
        // Validate old Password And New Password Are Same
        if ($request->isPasswordChange == 1) {
            $hashedpass = Auth::User()->password; // User Old Password
            // if old password request current password are same
            if (Hash::check($request->password, $hashedpass)) {
                return redirect()->back()->with('error', 'your old and new password is same . please type different one');
            }
        }
        // Validate image if want to profile image
        if ($request->image) {
            $request->validate([
                'image' =>  'image|mimes:jpeg,png,jpg,gif'
            ]);
        }
        //============= Now Data Update Time ============
        $user = User::FindOrFail(auth()->id());
        $user->name = $request->name;
        $user->email = $request->email;
        // First Check Image
        if ($request->image) {
            // if Old Image have then delete this (if isnot default one)
            $userOldImage = $user->profile_image_url;
            if (file_exists($userOldImage)) {
                if ($userOldImage != 'backend/images/default.png') {
                    unlink($userOldImage);
                }
            }
            // image Proccessing For Upload
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('backend/images/'), $imageName);
            // save profile pic
            $lastImage = 'backend/images/' . $imageName;
            $user->profile_image_url = $lastImage;
        }
        // First Check Password
        if ($request->password) {
            // password change Proccessing
            $user->password = Hash::make($request->password);
        }
        // Finally Save The User
        $user->save();
        return redirect()->back()->with('success', 'Profle Updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
