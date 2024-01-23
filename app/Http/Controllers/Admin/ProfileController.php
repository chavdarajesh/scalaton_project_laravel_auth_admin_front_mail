<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Mail\Admin\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Mail;


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
            'newpasswod' => 'required|min:6',
            'confirmnewpasswod' => 'required_with:newpasswod|same:newpasswod|min:6'
        ]);

        $user = Auth::user();
        if (!Hash::check($request->oldpassword, $user->password)) {
            return redirect()->back()->with('error', 'Current Password Does Not Match!');
        }
        $user->password = Hash::make($request->newpasswod);
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

    public function forgotPasswordGet()
    {
        return view('admin.auth.forgot-password');
    }
    public function forgotPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email,is_admin,1,status,1,is_verified,1'
        ]);
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now('Asia/Kolkata'),
        ]);
        $data = [
            'token' => $token
        ];
        $mail = Mail::to($request->email)->send(new ForgotPassword($data));
        return redirect()->route('admin.login.get')->with('message', 'Password Reset Link send Successfully To Your Email..');
    }

    public function ResetPasswordGet($token)
    {
        if (isset($token) && $token != '') {
            return view('admin.auth.showresetpasswordform', ['token' => $token]);
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }
    public function ResetPasswordPost(Request $request)
    {
        $request->validate([
            'newpassword' => 'required|min:6',
            'confirmnewpasswod' => 'required|same:newpassword|min:6'
        ]);
        if (!isset($request->token) || $request->token == '') {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }

        $updatePassword = DB::table('password_resets')->where('token', $request->token)->first();
        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }
        $user = User::where('email', $updatePassword->email)
            ->update(['password' => Hash::make($request->newpasswod)]);
        DB::table('password_resets')->where(['email' => $updatePassword->email])->delete();
        if ($user) {
            return redirect()->route('admin.login.get')->with('message', 'Your Password Has Been Updated!');
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }
}
