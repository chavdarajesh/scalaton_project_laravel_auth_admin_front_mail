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
    //
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
        $ValidatedData = Validator::make($request->all(), [
            'name' => 'required|max:40',
            'email' => 'required',
            'phone' => 'required ',
            'username' => 'required ',
            'address' => 'required',
            'dateofbirth' => 'required',
        ]);
        if ($ValidatedData->fails()) {
            return redirect()->back()->with('error', 'All Fileds are Required..');
        } else {
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
    }

    public function postprofilechangepassword(Request $request)
    {
        $ValidatedData = Validator::make($request->all(), [
            'oldpassword' => 'required',
            'newpassword' => 'min:6',
            'confirmnewpasswod' => 'required_with:newpassword|same:newpassword|min:6'
        ]);
        if ($ValidatedData->fails()) {
            return redirect()->back()->with('error', $ValidatedData->errors());
        } else {
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
}
