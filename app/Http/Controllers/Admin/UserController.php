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
            $User = $User->delete();
            if ($User) {
                return redirect()->route('admin.get.users')->with('message', 'User Delete  Sucssesfully..');
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
            $User = User::find($request->id);
            $User->name = $request['name'];
            $User->username = $request['username'];
            $User->email = $request['email'];
            $User->phone = $request['phone'];
            $User->address = $request['address'];
            $User->dateofbirth = $request['dateofbirth'];
            if ($request->pgrofilephoto) {
                $folderPath = public_path('assets/users/profilephoto/' . $request->id . '/');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $file = $request->file('pgrofilephoto');
                $imageoriginalname = str_replace(" ", "-", $file->getClientOriginalName());
                $imageName = time() . $imageoriginalname;
                $file->move($folderPath, $imageName);
                $User->profileimage = 'assets/users/profilephoto/' . $request->id . '/' . $imageName;
            }
            if ($request->password) {
                $User->password = Hash::make($request->password);
            }
            $User->save();

            if ($User) {
                return redirect()->route('admin.get.users')->with('message', 'User Update  Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..');
            }
        }
    }

    public function user_status_update(Request $request)
    {
        if ($request->id) {
            $User = User::find($request->id);
            $User->status = $request->status;
            $User = $User->update();
            if ($User) {
                return response()->json(['success' => 'Status change successfully.']);
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
                return response()->json(['success' => 'Verified Status change successfully.']);
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
