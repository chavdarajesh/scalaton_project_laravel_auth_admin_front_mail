<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function profilepage()
    {
        return view('front.profile.index');
    }
    public function postprofilepage(Request $request)
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

        $User = User::find(Auth::user()->id);
        $User->name = $request['name'];
        $User->username = $request['username'];
        $User->email = $request['email'];
        $User->phone = $request['phone'];
        $User->address = $request['address'];
        $User->dateofbirth = $request['dateofbirth'];

        if ($request->profileimage) {
            $folderPath = public_path('assets/images/users/profileimage/' . Auth::user()->id . '/');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            $file = $request->file('profileimage');
            $imageoriginalname = str_replace(" ", "-", $file->getClientOriginalName());
            $imageName = rand(1000, 9999) . time() . $imageoriginalname;
            $file->move($folderPath, $imageName);
            $User->profileimage = 'assets/images/users/profileimage/' . Auth::user()->id . '/' . $imageName;
            if ($request->old_profileimage && file_exists(public_path($request->old_profileimage))) {
                unlink(public_path($request->old_profileimage));
            }
        }
        $User->save();

        if ($User) {
            return redirect()->route('front.profilepage')->with('message', 'Profile Updated Sucssesfully..');
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }

    public function postprofilechangepassword(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required|min:6',
            'newpassword' => 'required|min:6',
            'confirmnewpassword' => 'required_with:newpassword|same:newpassword|min:6'
        ]);
        $user = Auth::user();
        if (!Hash::check($request->oldpassword, $user->password)) {
            return redirect()->back()->with('error', 'Current password does not match!');
        }
        $user->password = Hash::make($request->newpassword);
        $user->save();
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('front.login')->with('message', 'Password changed Successfully Please Login Again..');;
    }
}
