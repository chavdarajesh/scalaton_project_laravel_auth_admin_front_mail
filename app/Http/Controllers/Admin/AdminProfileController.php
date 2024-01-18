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
        // toastr()->warning('--------');
        return view('admin.profile.change-password');
    }
    public function adminprofilesetting()
    {
        // toastr()->warning('--------');
        return view('admin.profile.profile-setting');
    }
    public function adminprofilesettingpost(Request $request)
    {
        $ValidatedData = Validator::make($request->all(), [
            'name' => 'required|max:20',
            'phone' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'username' => 'required',
            'address' => 'required',
            'dateofbirth' => 'required',
        ]);

        if ($ValidatedData->fails()) {
            return redirect()->back()->with('error', 'All Fileds are Required..');
        } else {
            $user = Auth::user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->username = $request->username;
            $user->address = $request->address;
            $user->dateofbirth = $request->dateofbirth;

            if ($request->profilephoto) {
                $folderPath = public_path('assets/users/profilephoto/' . $user->id . '/');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $file = $request->file('profilephoto');
                $imageoriginalname = str_replace(" ", "-", $file->getClientOriginalName());
                $imageName = time() . $imageoriginalname;
                $file->move($folderPath, $imageName);
                $user->profileimage = 'assets/users/profilephoto/' . $user->id . '/' . $imageName;
            }
            $user->save();
            return redirect()->route('admin.profile.setting')->with('message', 'Profile Updated Succesfully..');
        }
    }
    public function adminprofilsettingchangepasswordepost(Request $request)
    {
        $ValidatedData = Validator::make($request->all(), [
            'adminoldpassword' => 'required',
            'adminnewpassword' => 'min:6',
            'adminconfirmnewpasswod' => 'required_with:adminnewpassword|same:adminnewpassword|min:6'
        ]);
        if ($ValidatedData->fails()) {
            return redirect()->back()->with('error', $ValidatedData->errors());
        } else {
            $user = Auth::user();
            if (!Hash::check($request->adminoldpassword, $user->password)) {
                return redirect()->back()->with('error', 'Current password does not match!');
            }
            $user->password = Hash::make($request->adminnewpassword);
            $user->save();
            Auth::logout();
            $request->session()->flush();
            return redirect()->route('admin.login')->with('message', 'Password changed Successfully Please Login Again..');;
        }
    }

    public function adminforgotpasswordget()
    {
        return view('admin.auth.forgot-password');
    }
    public function adminforgotpasswordpost(Request $request)
    {
        $ValidatedData = Validator::make($request->all(), [
            'email' => 'required|email|exists:users'
        ]);
        if ($ValidatedData->fails()) {
            return redirect()->back()->with('error', $ValidatedData->errors());
        } else {
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
            return redirect()->route('admin.login')->with('message', 'Mail send  Successfully Please Chacek MAil..');
        }
    }

    public function showResetPasswordFormget($token)
    {
        return view('admin.mail.showresetpasswordform', ['token' => $token]);
    }
    public function submitResetPasswordFormpost(Request $request)
    {
        $ValidatedData = Validator::make($request->all(), [
            'adminnewpassword' => 'min:6',
            'adminconfirmnewpasswod' => 'required_with:adminnewpassword|same:adminnewpassword|min:6'
        ]);
        if ($ValidatedData->fails()) {
            return redirect()->back()->with('error', $ValidatedData->errors());
        } else {
            $updatePassword = DB::table('password_resets')->where('token', $request->token)->first();
            if (!$updatePassword) {
                return back()->withInput()->with('error', 'Invalid token!');
            }
            $user = User::where('email', $updatePassword->email)
                ->update(['password' => Hash::make($request->adminnewpassword)]);
            DB::table('password_resets')->where(['email' => $updatePassword->email])->delete();
            return redirect()->route('admin.login')->with('message', 'Your password has been changed!');
        }
    }
}
