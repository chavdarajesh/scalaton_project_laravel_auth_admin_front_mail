<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function get_users()
    {
        $Users = User::where('is_admin', 0)->get();
        return view('admin.user.index', ['Users' => $Users]);
    }

    public function user_delete($id)
    {
        if ($id) {
            $User = User::find($id);
            if ($User->profileimage && file_exists(public_path($User->profileimage))) {
                unlink(public_path($User->profileimage));
            }
            $User = $User->delete();
            if ($User) {
                return redirect()->route('admin.get.users')->with('message', 'User Deleted Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..!');
            }
        } else {
            return redirect()->back()->with('error', 'User Not Found..!');
        }
    }

    public function get_user_add()
    {
        return view('admin.user.add');
    }

    public function post_user(Request $request)
    {
        $request->validate([
            'name' => 'required|max:40',
            'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL',
            'phone' => 'required |unique:users,phone,NULL,id,deleted_at,NULL',
            'username' => 'required |unique:users,username,NULL,id,deleted_at,NULL',
            'address' => 'required',
            'dateofbirth' => 'required',
            'password' => 'required|min:6',
            'confirmpassword' => 'required_with:password|same:password|min:6',
            'profileimage' => 'file|image|mimes:jpeg,png,jpg,gif|max:5000',
            'referral_code' => 'exists:users',
        ]);

        $User = new User();
        $User->name = $request['name'];
        $User->username = $request['username'];
        $User->email = $request['email'];
        $User->phone = $request['phone'];
        $User->address = $request['address'];
        $User->dateofbirth = $request['dateofbirth'];
        $User->is_admin = 0;
        $User->status = 1;
        $User->is_verified = 1;
        $User->created_at = Carbon::now('Asia/Kolkata');
        $User->email_verified_at = Carbon::now('Asia/Kolkata');
        $User->otp = null;
        $User->password = Hash::make($request->password);
        $User->referral_code = Str::slug($request['username'], "-");
        $User->other_referral_code = $request['referral_code'] ? $request['referral_code'] : '';

        if ($request->profileimage) {
            $folderPath = public_path('assets/images/users/profileimage/' . $request->id . '/');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            $file = $request->file('profileimage');
            $imageoriginalname = str_replace(" ", "-", $file->getClientOriginalName());
            $imageName = rand(1000, 9999) . time() . $imageoriginalname;
            $file->move($folderPath, $imageName);
            $User->profileimage = 'assets/images/users/profileimage/' . $request->id . '/' . $imageName;
            if ($request->old_profileimage && file_exists(public_path($request->old_profileimage))) {
                unlink(public_path($request->old_profileimage));
            }
        }

        $User->save();
        if ($User) {
            return redirect()->route('admin.get.users')->with('message', 'User Added Sucssesfully..');
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }


    public function user_edit($id)
    {
        $User = User::find($id);
        if ($User) {
            return view('admin.user.edit', ['User' => $User]);
        } else {
            return redirect()->back()->with('error', 'User Not Found..!');
        }
    }
    public function user_view($id)
    {
        $User = User::find($id);
        if ($User) {
            return view('admin.user.view', ['User' => $User]);
        } else {
            return redirect()->back()->with('error', 'User Not Found..!');
        }
    }

    public function user_update(Request $request)
    {
        if ($request->id) {
            $request->validate([
                'name' => 'required|max:40',
                'email' => 'required|email|unique:users,email,' . $request->id,
                'phone' => 'required|unique:users,phone,' . $request->id,
                'username' => 'required|unique:users,username,' . $request->id,
                'address' => 'required',
                'dateofbirth' => 'required',
                'password' => 'nullable|min:6',
                'confirmpassword' => 'nullable|same:password|min:6',
                'profileimage' => 'file|image|mimes:jpeg,png,jpg,gif|max:5000',
                'referral_code' => 'exists:users',
            ]);

            $User = User::find($request->id);
            $User->name = $request['name'];
            $User->username = $request['username'];
            $User->email = $request['email'];
            $User->phone = $request['phone'];
            $User->address = $request['address'];
            $User->dateofbirth = $request['dateofbirth'];

            if ($request->profileimage) {
                $folderPath = public_path('assets/images/users/profileimage/' . $request->id . '/');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $file = $request->file('profileimage');
                $imageoriginalname = str_replace(" ", "-", $file->getClientOriginalName());
                $imageName = rand(1000, 9999) . time() . $imageoriginalname;
                $file->move($folderPath, $imageName);
                $User->profileimage = 'assets/images/users/profileimage/' . $request->id . '/' . $imageName;
                if ($request->old_profileimage && file_exists(public_path($request->old_profileimage))) {
                    unlink(public_path($request->old_profileimage));
                }
            }
            if ($request->password) {
                $User->password = Hash::make($request->password);
            }
            if ($request->referral_code) {
                $User->other_referral_code = $request->referral_code;
            }
            $User->save();

            if ($User) {
                return redirect()->route('admin.get.users')->with('message', 'User Update Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..');
            }
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }

    public function user_status_update(Request $request)
    {
        if ($request->id) {
            $User = User::find($request->id);
            $User->status = $request->status;
            $User = $User->update();
            if ($User) {
                return response()->json(['success' => 'Status Update Successfully.']);
            } else {
                return response()->json(['error' => 'Somthing Went Wrong..!']);
            }
        } else {
            return response()->json(['error' => 'User Not Found..!']);
        }
    }

    public function user_is_verified_update(Request $request)
    {
        if ($request->id) {
            $User = User::find($request->id);
            $User->is_verified = $request->is_verified;
            $User = $User->update();
            if ($User) {
                return response()->json(['success' => 'Verified Status Update Successfully.']);
            } else {
                return response()->json(['error' => 'Somthing Went Wrong..!']);
            }
        } else {
            return response()->json(['error' => 'User Not Found..!']);
        }
    }

    public function get_user_referrals($id)
    {
        if ($id) {
            $User = User::find($id);
            $Users = User::where('is_admin', 0)->where('other_referral_code', $User->referral_code)->get();
            return view('admin.user_referrals.user_referrals', ['Users' => $Users, 'User' => $User]);
        } else {
            return redirect()->back()->with('error', 'User Not Found..');
        }
    }
}
