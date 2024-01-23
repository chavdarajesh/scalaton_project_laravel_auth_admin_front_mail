<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function profileSettingsPasswordIndex()
    {
        return view('admin.profile.password');
    }
    public function profileSettingsPasswordSave(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required|min:6',
            'newpassword' => 'required|min:6',
            'confirmnewpassword' => 'required_with:newpassword|same:newpassword|min:6'
        ]);

        $user = Auth::user();
        if (!Hash::check($request->oldpassword, $user->password)) {
            return redirect()->back()->with('error', 'Current Password Does Not Match!');
        }
        $user->password = Hash::make($request->newpassword);
        $user->save();
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('admin.login.get')->with('message', 'Password Updated Successfully Please Login Again..');;
    }

    public function profileSettingIndex()
    {
        return view('admin.profile.setting');
    }

    public function profileSettingSave(Request $request)
    {

        $request->validate([
            'name' => 'required|max:40',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'phone' => 'required|min:10|unique:users,phone,' . Auth::user()->id,
            'username' => 'required|unique:users,username,' . Auth::user()->id,
            'address' => 'required',
            'dateofbirth' => 'required',
            'profileimage' => 'file|image|mimes:jpeg,png,jpg,gif|max:5000'
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->username = $request->username;
        $user->address = $request->address;
        $user->dateofbirth = $request->dateofbirth;

        if ($request->profileimage) {
            $folderPath = public_path('assets/images/users/profileimage/' . Auth::user()->id . '/');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            $file = $request->file('profileimage');
            $imageoriginalname = str_replace(" ", "-", $file->getClientOriginalName());
            $imageName = rand(1000, 9999) . time() . $imageoriginalname;
            $file->move($folderPath, $imageName);
            $user->profileimage = 'assets/images/users/profileimage/' . Auth::user()->id . '/' . $imageName;
            if ($request->old_profileimage && file_exists(public_path($request->old_profileimage))) {
                unlink(public_path($request->old_profileimage));
            }
        }
        $user->save();
        if ($user) {
            return redirect()->route('admin.profile.setting.index')->with('message', 'Profile Updated Succesfully..');
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }
}
