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


    public function edit($id)
    {
        $user = User::FindOrFail(Auth::user()->id);
        return view('admin.profile.profile-edit')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        // Data Validation
        $request->validate([
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
                Toastr::error('current password not match with your old password!', 'Password Error!', ["positionClass" => "toast-top-center"]);
                return redirect()->back();
            }
        }

        // Validate old Password And New Password Are Same
        if ($request->change_password == 1) {
            $hashedpass = Auth::User()->password; // User Old Password

            if (Hash::check($request->password, $hashedpass)) {
                Toastr::error('Opps! You entered same password!', 'Password Error!', ["positionClass" => "toast-top-center"]);
                return redirect()->back();
            }
        }

        // Validate image if want to profile image
        if ($request->dpicture) {
            $request->validate([
                'dpicture' =>  'image|mimes:jpeg,png,jpg,gif'
            ]);
        }

        $user = User::FindOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->dpicture) {
            $oldPicture = $user->dpicture;
            if (file_exists($oldPicture)) {
                if ($oldPicture != 'backend/images/default.png') {
                    unlink($oldPicture);
                }
            }
            $imageName = time() . '.' . $request->dpicture->extension();
            $request->dpicture->move(public_path('backend/admin/images/'), $imageName);
            $newPicture = 'backend/admin/images/' . $imageName;
            $user->dpicture = $newPicture;
        }
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        Toastr::success('WOW! Your profile updated successfully!', 'Update Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('profile.view', $id);
    }


    public function destroy($id)
    {
        //
    }
}
