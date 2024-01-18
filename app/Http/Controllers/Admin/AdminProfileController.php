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


class AdminProfileController extends Controller
{
    //
    public function adminprofileprofilechangepassword()
    {
        return view('admin.profile.change-password');
    }
    public function adminprofilesetting()
    {
        return view('admin.profile.profile-setting');
    }
    public function adminprofilesettingpost(Request $request)
    {

        $request->validate([
            'name' => 'required|max:40',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'phone' => 'required|unique:users,phone,' . Auth::user()->id,
            'username' => 'required|unique:users,username,' . Auth::user()->id,
            'address' => 'required',
            'dateofbirth' => 'required',
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
        return redirect()->route('admin.profile.setting')->with('message', 'Profile Updated Succesfully..');
    }
    public function adminprofilsettingchangepasswordepost(Request $request)
    {
        $request->validate([
            'adminoldpassword' => 'required',
            'adminnewpassword' => 'min:6',
            'adminconfirmnewpasswod' => 'required_with:adminnewpassword|same:adminnewpassword|min:6'
        ]);

        $user = Auth::user();
        if (!Hash::check($request->adminoldpassword, $user->password)) {
            return redirect()->back()->with('error', 'Current Password Does Not Match!');
        }
        $user->password = Hash::make($request->adminnewpassword);
        $user->save();
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('admin.login')->with('message', 'Password Updated Successfully Please Login Again..');;
    }

    public function adminforgotpasswordget()
    {
        return view('admin.auth.forgot-password');
    }
    public function adminforgotpasswordpost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
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
        Mail::to($request->email)->send(new ForgotPassword($data));
        return redirect()->route('admin.login')->with('message', 'Password Reset Link send Successfully To Your Email..');
    }

    public function showResetPasswordFormget($token)
    {
        return view('admin.mail.showresetpasswordform', ['token' => $token]);
    }
    public function submitResetPasswordFormpost(Request $request)
    {
        $request->validate([
            'newpassword' => 'required|min:6',
            'confirmnewpasswod' => 'required|same:newpassword|min:6'
        ]);

        $updatePassword = DB::table('password_resets')->where('token', $request->token)->first();
        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }
        $user = User::where('email', $updatePassword->email)
            ->update(['password' => Hash::make($request->adminnewpassword)]);
        DB::table('password_resets')->where(['email' => $updatePassword->email])->delete();
        return redirect()->route('admin.login')->with('message', 'Your Password Has Been Updated!');
    }
}
