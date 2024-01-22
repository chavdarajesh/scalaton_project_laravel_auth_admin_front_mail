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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $draw = $request->get('draw');
            $start = $request->get("start");
            $rowperpage = $request->get("length") ?? 10;

            $columnIndex_arr = $request->get('order');
            $columnName_arr = $request->get('columns');
            $order_arr = $request->get('order');
            $search_arr = $request->get('search');

            $columnIndex = $columnIndex_arr[0]['column']  ?? '0'; // Column index
            $columnName = $columnName_arr[$columnIndex]['data']; // Column name
            $columnSortOrder = $order_arr[0]['dir'] ?? 'desc'; // asc or desc
            $searchValue = $search_arr['value']; // Search value

            // Total records
            $totalRecords = User::select('count(*) as allcount')->where('is_admin', 0)->count();
            $totalRecordswithFilter =
                User::select('count(*) as allcount')->where('is_admin', 0)
                ->where(function ($query) use ($searchValue) {
                    $query->where('id', 'like', '%' . $searchValue . '%')
                        ->orWhere('name', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%')
                        ->orWhere('status', 'like', '%' . $searchValue . '%')
                        ->orWhere('is_verified', 'like', '%' . $searchValue . '%');
                })
                ->count();

            // Get records, also we have included search filter as well
            $records = User::where('is_admin', 0)
                ->where(function ($query) use ($searchValue) {
                    $query->where('id', 'like', '%' . $searchValue . '%')
                        ->orWhere('name', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%')
                        ->orWhere('status', 'like', '%' . $searchValue . '%')
                        ->orWhere('is_verified', 'like', '%' . $searchValue . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->select('*')
                ->skip($start)
                ->take($rowperpage)
                ->get();

            $data_arr = array();

            foreach ($records as $row) {
                $html = '<a href="' . route("admin.users.view", $row->id) . '"> <button type="button"
                            class="btn btn-icon btn-outline-info">
                            <i class="bx bx-show"></i>
                        </button></a>
                    <a href="' . route("admin.users.edit", $row->id) . '"> <button type="button"
                            class="btn btn-icon btn-outline-warning">
                            <i class="bx bxs-edit"></i>
                        </button></a>

                    <button type="button" class="btn btn-icon btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#delete-modal-' . $row->id . '">
                        <i class="bx bx-trash-alt"></i>
                    </button>
                    <div class="modal fade" id="delete-modal-' . $row->id . '"
                        tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <form action="' . route("admin.users.delete", $row->id) . '"
                            method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Delete Item
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <h3>Do You Want To Really Delete This Item?</h3>
                                        ' . csrf_field() . '
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                    </form>
                            </div>
                        </div>
                    </div>';
                $data_arr[] = array(
                    "id" => '<strong>' . $row->id . '</strong>',
                    "referCount" => '<a href="' . route("admin.users.referrals", $row->id) . '"><span class="badge badge-center bg-success">' . User::get_total_use_referral_user_by_id($row->id) . '</span></a>',
                    "name" => '<a href="' . route("admin.users.view", $row->id) . '">' . $row->name . '</a>',
                    "email" => $row->email,
                    "status" => ' <div class="d-flex justify-content-center align-items-center form-check form-switch"><input data-id="' . $row->id . '" style="width: 60px;height: 25px;" class="form-check-input status-toggle" type="checkbox" id="flexSwitchCheckDefault" ' . ($row->status ? "checked" : "") . '  ></div>',
                    "verify" => ' <div class="d-flex justify-content-center align-items-center form-check form-switch"><input data-id="' . $row->id . '" style="width: 60px;height: 25px;" class="form-check-input verify-toggle" type="checkbox" id="flexSwitchCheckDefault" ' . ($row->is_verified ? "checked" : "") . '  ></div>',
                    "created_at" => $row->created_at ? Carbon::parse($row->created_at)->setTimezone('Asia/Kolkata')->toDateTimeString() : '',
                    "actions" => $html,
                );
            }

            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordswithFilter,
                "aaData" => $data_arr,
            );

            echo json_encode($response);
        } else {
            return view('admin.users.index');
        }
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function save(Request $request)
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
            return redirect()->route('admin.users.index')->with('message', 'User Added Sucssesfully..');
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }


    public function edit($id)
    {
        $User = User::find($id);
        if ($User) {
            return view('admin.users.edit', ['User' => $User]);
        } else {
            return redirect()->back()->with('error', 'User Not Found..!');
        }
    }
    public function view($id)
    {
        $User = User::find($id);
        if ($User) {
            return view('admin.users.view', ['User' => $User]);
        } else {
            return redirect()->back()->with('error', 'User Not Found..!');
        }
    }

    public function update(Request $request)
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
                return redirect()->route('admin.users.index')->with('message', 'User Update Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..');
            }
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }

    public function delete($id)
    {
        if ($id) {
            $User = User::find($id);
            if ($User->profileimage && file_exists(public_path($User->profileimage))) {
                unlink(public_path($User->profileimage));
            }
            $User = $User->delete();
            if ($User) {
                return redirect()->route('admin.users.index')->with('message', 'User Deleted Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..!');
            }
        } else {
            return redirect()->back()->with('error', 'User Not Found..!');
        }
    }


    public function statusToggle(Request $request)
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

    public function verifyToggle(Request $request)
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

    public function userReferrals(Request $request, $id)
    {
        if ($id) {
            $User = User::find($id);
            if ($request->ajax()) {
                $draw = $request->get('draw');
                $start = $request->get("start");
                $rowperpage = $request->get("length") ?? 10;

                $columnIndex_arr = $request->get('order');
                $columnName_arr = $request->get('columns');
                $order_arr = $request->get('order');
                $search_arr = $request->get('search');

                $columnIndex = $columnIndex_arr[0]['column']  ?? '0'; // Column index
                $columnName = $columnName_arr[$columnIndex]['data']; // Column name
                $columnSortOrder = $order_arr[0]['dir'] ?? 'desc'; // asc or desc
                $searchValue = $search_arr['value']; // Search value

                // Total records
                $totalRecords = User::select('count(*) as allcount')->where('is_admin', 0)->where('other_referral_code', $User->referral_code)->count();
                $totalRecordswithFilter =
                    User::select('count(*) as allcount')->where('is_admin', 0)->where('other_referral_code', $User->referral_code)
                    ->where(function ($query) use ($searchValue) {
                        $query->where('id', 'like', '%' . $searchValue . '%')
                            ->orWhere('name', 'like', '%' . $searchValue . '%')
                            ->orWhere('email', 'like', '%' . $searchValue . '%')
                            ->orWhere('status', 'like', '%' . $searchValue . '%')
                            ->orWhere('is_verified', 'like', '%' . $searchValue . '%');
                    })
                    ->count();

                // Get records, also we have included search filter as well
                $records = User::where('is_admin', 0)->where('other_referral_code', $User->referral_code)
                    ->where(function ($query) use ($searchValue) {
                        $query->where('id', 'like', '%' . $searchValue . '%')
                            ->orWhere('name', 'like', '%' . $searchValue . '%')
                            ->orWhere('email', 'like', '%' . $searchValue . '%')
                            ->orWhere('status', 'like', '%' . $searchValue . '%')
                            ->orWhere('is_verified', 'like', '%' . $searchValue . '%');
                    })
                    ->orderBy($columnName, $columnSortOrder)
                    ->select('*')
                    ->skip($start)
                    ->take($rowperpage)
                    ->get();

                $data_arr = array();

                foreach ($records as $row) {
                    $html = '<a href="' . route("admin.users.view", $row->id) . '"> <button type="button"
                            class="btn btn-icon btn-outline-info">
                            <i class="bx bx-show"></i>
                        </button></a>
                    <a href="' . route("admin.users.edit", $row->id) . '"> <button type="button"
                            class="btn btn-icon btn-outline-warning">
                            <i class="bx bxs-edit"></i>
                        </button></a>

                    <button type="button" class="btn btn-icon btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#delete-modal-' . $row->id . '">
                        <i class="bx bx-trash-alt"></i>
                    </button>
                    <div class="modal fade" id="delete-modal-' . $row->id . '"
                        tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <form action="' . route("admin.users.delete", $row->id) . '"
                            method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Delete Item
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <h3>Do You Want To Really Delete This Item?</h3>
                                        ' . csrf_field() . '
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                    </form>
                            </div>
                        </div>
                    </div>';
                    $data_arr[] = array(
                        "id" => '<strong>' . $row->id . '</strong>',
                        "name" => '<a href="' . route("admin.users.view", $row->id) . '">' . $row->name . '</a>',
                        "email" => $row->email,
                        "status" => ' <div class="d-flex justify-content-center align-items-center form-check form-switch"><input data-id="' . $row->id . '" style="width: 60px;height: 25px;" class="form-check-input status-toggle" type="checkbox" id="flexSwitchCheckDefault" ' . ($row->status ? "checked" : "") . '  ></div>',
                        "verify" => ' <div class="d-flex justify-content-center align-items-center form-check form-switch"><input data-id="' . $row->id . '" style="width: 60px;height: 25px;" class="form-check-input verify-toggle" type="checkbox" id="flexSwitchCheckDefault" ' . ($row->is_verified ? "checked" : "") . '  ></div>',
                        "created_at" => $row->created_at ? Carbon::parse($row->created_at)->setTimezone('Asia/Kolkata')->toDateTimeString() : '',
                        "actions" => $html,
                    );
                }

                $response = array(
                    "draw" => intval($draw),
                    "iTotalRecords" => $totalRecords,
                    "iTotalDisplayRecords" => $totalRecordswithFilter,
                    "aaData" => $data_arr,
                );

                echo json_encode($response);
            } else {
                return view('admin.users.referrals', ['User' => $User]);
            }
        } else {
            return redirect()->back()->with('error', 'User Not Found..');
        }
    }
}
