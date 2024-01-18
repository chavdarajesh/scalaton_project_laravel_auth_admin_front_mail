<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    //
    public function get_blogs()
    {
        $Blogs = Blog::all();
        return view('admin.blogs.blogs_index', ['Blogs' => $Blogs]);
    }
    public function get_blog_add()
    {
        return view('admin.blogs.blog_add');
    }
    public function post_blog(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $Blog = new Blog();
        $Blog->title = $request['title'];
        $Blog->description = $request['description'];
        $Blog->author = $request['author'] ?  $request['author'] : Auth::user()->name;
        $Blog->published_date = $request['published_date'] ? $request['published_date'] : date('Y-m-d');
        $Blog->status = 1;
        if ($request->image) {
            if ($request->old_image && file_exists(public_path($request->old_image))) {
                unlink(public_path($request->old_image));
            }
            $folderPath = public_path('assets/images/blogs/images/');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            $file = $request->file('image');
            $imageoriginalname = str_replace(" ", "-", $file->getClientOriginalName());
            $imageName = rand(1000, 9999) . time() . $imageoriginalname;
            $file->move($folderPath, $imageName);
            $Blog->image = 'assets/images/blogs/images/' . $imageName;
        }
        $Blog = $Blog->save();
        if ($Blog) {
            return redirect()->route('admin.get.blogs')->with('message', 'Blog Added Sucssesfully..');
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }

    public function blog_delete($id)
    {
        if ($id) {
            $Blog = Blog::find($id);
            if ($Blog->image && file_exists(public_path($Blog->image))) {
                unlink(public_path($Blog->image));
            }
            $Blog = $Blog->delete();
            if ($Blog) {
                return redirect()->route('admin.get.blogs')->with('message', 'Blog Deleted Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..!');
            }
        } else {
            return redirect()->back()->with('error', 'Blog Not Found..!');
        }
    }

    public function blog_edit($id)
    {
        $Blog = Blog::find($id);
        if ($Blog) {
            return view('admin.blogs.blog_edit', ['Blog' => $Blog]);
        } else {
            return redirect()->back()->with('error', 'Blog Not Found..!');
        }
    }
    public function blog_view($id)
    {
        $Blog = Blog::find($id);
        if ($Blog) {
            return view('admin.blogs.blog_view', ['Blog' => $Blog]);
        } else {
            return redirect()->back()->with('error', 'Blog Not Found..!');
        }
    }

    public function blog_update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $Blog = Blog::find($request->id);
        if ($Blog) {
            $Blog->title = $request['title'];
            $Blog->description = $request['description'];
            $Blog->author = $request['author'] ?  $request['author'] : Auth::user()->name;
            $Blog->published_date = $request['published_date'] ? $request['published_date'] : date('Y-m-d');
            $Blog->status = 1;
            if ($request->image) {
                $folderPath = public_path('assets/images/blogs/images/');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $file = $request->file('image');
                $imageoriginalname = str_replace(" ", "-", $file->getClientOriginalName());
                $imageName = rand(1000, 9999) . time() . $imageoriginalname;
                $file->move($folderPath, $imageName);
                $Blog->image = 'assets/images/blogs/images/' . $imageName;
                if ($request->old_image && file_exists(public_path($request->old_image))) {
                    unlink(public_path($request->old_image));
                }
            }
            $Blog->status = 1;
            $Blog = $Blog->update();
            if ($Blog) {
                return redirect()->route('admin.get.blogs')->with('message', 'Blog Updated Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..');
            }
        } else {
            return redirect()->back()->with('error', 'Blog Not Found..!');
        }
    }
    public function blog_status_update(Request $request)
    {
        if ($request->id) {
            $Blog = Blog::find($request->id);
            $Blog->status = $request->status;
            $Blog = $Blog->update();
            if ($Blog) {
                return response()->json(['success' => 'Status Updated Successfully.']);
            } else {
                return response()->json(['error' => 'Somthing Went Wrong..!']);
            }
        } else {
            return response()->json(['error' => 'Blog Not Found..!']);
        }
    }
}
