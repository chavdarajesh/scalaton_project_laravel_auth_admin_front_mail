<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function dashboard()
    {
        $data['Total_Users'] = User::where('is_admin', 0)->count();
        $data['Total_Verified_Users'] = User::where('is_admin', 0)->where('is_verified', 1)->count();
        $data['Total_Not_Verified_Users'] = User::where('is_admin', 0)->where('is_verified', 0)->count();
        $data['Total_Active_Users'] = User::where('is_admin', 0)->where('status', 1)->count();
        $data['Total_Not_Active_Users'] = User::where('is_admin', 0)->where('status', 0)->count();

        $data['Total_Blogs'] = Blog::count();
        $data['Total_Active_Blogs'] = Blog::where('status', 1)->count();
        $data['Total_In_Active_Blogs'] = Blog::where('status', 0)->count();

        $data['Total_All_Blogs'] = Blog::withTrashed()->count();
        return view('admin.dashboard', ['data' => $data]);
    }
}
