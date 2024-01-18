<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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
