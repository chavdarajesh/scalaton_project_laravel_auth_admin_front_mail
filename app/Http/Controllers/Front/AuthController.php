<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Front\ForgotPassword;
use App\Mail\Front\OTPVerification;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    //
    public function login()
    {
        if (!Auth::check()) {
            return view('front.auth.login');
        } else {
            return redirect()->route('front.homepage')->with('message', 'User Login Successfully');
        }
    }
    public function register()
    {
        if (!Auth::check()) {
            return view('front.auth.register');
        } else {
            return redirect()->route('front.homepage')->with('message', 'User Login Successfully');
        }
    }




    public function postregister(Request $request)
    {
        $request->validate([
            'name' => 'required|max:40',
            'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL',
            'phone' => 'required |unique:users,phone,NULL,id,deleted_at,NULL',
            'username' => 'required |unique:users,username,NULL,id,deleted_at,NULL',
            'address' => 'required',
            'dateofbirth' => 'required',
            'accept_t_c' => 'required',
            'referral_code' => 'exists:users',
            'password' => 'required|min:6',
            'confirmpasswod' => 'required|same:password|min:6'
        ]);

        $user = new User();
        $user->name = $request['name'];
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->address = $request['address'];
        $user->dateofbirth = $request['dateofbirth'];
        $user->referral_code = Str::slug($request['username'], "-");
        $user->other_referral_code = $request['referral_code'] ? $request['referral_code'] : '';
        $random_pass = rand(100000, 999999);
        $user->password = Hash::make($request['password']);
        $user->otp = $random_pass;
        $user->save();

        if ($user) {
            $data = [
                'otp' => $random_pass
            ];
            $user_id = encrypt($user->id);
            Mail::to($request->email)->send(new OTPVerification($data));
            return redirect()->route('front.otp_verification.get', ['id' => $user_id])->with('message', 'Otp Send To Your Email. Please Enter OTP To Verify Your Account..');
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }
    public function showotp_verificationFormget($id)
    {
        $id = decrypt($id);
        if ($id) {
            return view('front.auth.otp_verification', ['user_id' => $id])->with('message', 'Please Enter OTP To Verify Your Account..');
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }
    public function postotp_verification(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'email' => 'required|email|exists:users',
            'otp' => 'required|min:6|max:6',
        ]);

        $user_email_check  = User::where([['email', '=', $request->email]])->first();
        if ($user_email_check) {
            $user  = User::where('id', $request->user_id)->where('email', $request->email)->where('otp', $request->otp)->first();
            if ($user) {
                User::where('id', '=', $request->user_id)->where('email', '=', $request->email)->update(['otp' => null]);
                User::where('id', '=', $request->user_id)->where('email', '=', $request->email)->update(['is_verified' => 1]);
                User::where('id', '=', $request->user_id)->where('email', '=', $request->email)->update(['email_verified_at' =>  Carbon::now('Asia/Kolkata')]);
                // if (Auth::attempt(['email' => $request->email, 'password' => $request->otp, 'is_verified' => 1, 'status' => 1])) {
                //     return redirect()->route('front.homepage')->with('message', 'Account Created Successfully..');
                // } else {
                //     return redirect()->back()->with('error', 'Somthing Went Wrong..');
                // }
                return redirect()->route('front.login')->with('message', 'Your account is verified Please login..');
            } else {
                return redirect()->back()->with('error', 'OTP Is Invalid..!');
            }
        } else {
            return redirect()->back()->with('error', 'OTP Is Invalid..!!');
        }
    }

    public function postlogin(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                Rule::exists('users')->where(function ($query) use ($request) {
                    $query->where('email', $request->input('email'))
                        ->orWhere('username', $request->input('email'));
                }),
            ],
            'password' => 'required|min:6',
        ], [
            'email.required' => 'The email or username field is required.',
            'email.exists' => 'The provided email or username does not exist.',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_verified' => 1, 'status' => 1]) || Auth::attempt(['username' => $request->email, 'password' => $request->password, 'is_verified' => 1, 'status' => 1])) {
            if (Auth::user()->email_verified_at != null && Auth::user()->otp == null) {
                return redirect()->route('front.homepage')->with('message', 'User Login Successfully');
            } else {
                Auth::logout();
                $request->session()->flush();
                return redirect()->back()->with('error', 'User Not Verified...');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Credantials');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('front.homepage')->with('message', 'User Logout Successfully');;
    }


    public function forgotpasswordget()
    {
        return view('front.auth.forget_password');
    }

    public function postforgotpassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);
        $user = User::where('email', $request->email)->where('status', 1)->where('is_verified', 1)->first();
        if ($user) {

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
            return redirect()->route('front.login')->with('message', 'Password Reset Link send Successfully Please Check your Email..');
        } else {
            return redirect()->back()->with('error', 'User Not Found..!');
        }
    }

    public function showResetPasswordFormget($token)
    {
        return view('front.auth.showresetpasswordform', ['token' => $token]);
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
            ->update(['password' => Hash::make($request->newpassword)]);
        DB::table('password_resets')->where(['email' => $updatePassword->email])->delete();
        if ($user) {
            return redirect()->route('front.login')->with('message', 'Your password has been changed!');
        } else {
            return redirect()->route('front.login')->with('error', 'Somthing Went Wrong..!');
        }
    }
}
