<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    //
    public function adminloginget()
    {
        if (Auth::check()) {
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('admin.dashboard')->with('message', 'Admin Login Successfully');
            } else {
                return redirect()->route('front.homepage')->with('error', 'User Not Acees Admin Site..!');
            }
        } else {
            return view('admin.auth.login');
        }
    }
    public function adminloginpost(Request $request)
    {
        $ValidatedData = Validator::make($request->all(), [
            'adminpassword' => 'required | min:6',
            'adminemail' => 'required|email'
        ]);
        if ($ValidatedData->fails()) {
            return redirect()->back()->with('error', 'All Fileds are Required..');
            // return redirect()->back()->withInput()->withErrors($ValidatedData);
        } else {
            if (!Auth::check()) {
                if (Auth::attempt(['email' => $request->adminemail, 'password' => $request->adminpassword, 'is_verified' => 1, 'status' => 1])) {
                    if (Auth::user()->is_admin == 1) {
                        return redirect()->route('admin.dashboard')->with('message', 'Admin Login Successfully');
                        } else {
                            return redirect()->back()->with('error', 'You have not Admin access');
                        }
                    } else {
                        return redirect()->back()->with('errors', 'Invalid Credantials');
                    }

            } else {
                if (Auth::user()->is_admin == 1) {
                    return redirect()->route('admin.dashboard')->with('message', 'Admin Login Successfully');
                }
                else{
                    return redirect()->route('front.homepage')->with('error', 'User Not Acees Admin Site..!');
                }
            }
        }
    }
    public function admindashboard()
    {
        $data['Total_Users'] = User::where('is_admin', 0)->count();
        $data['Total_Verified_Users'] = User::where('is_admin', 0)->where('is_verified', 1)->count();
        $data['Total_Not_Verified_Users'] = User::where('is_admin', 0)->where('is_verified', 0)->count();
        $data['Total_Active_Users'] = User::where('is_admin', 0)->where('status', 1)->count();
        $data['Total_Not_Active_Users'] = User::where('is_admin', 0)->where('status', 0)->count();
        return view('admin.dashboard', ['data' => $data]);
    }
    public function adminlogout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('admin.login')->with('message', 'Admin Logout Successfully');;
    }
}
