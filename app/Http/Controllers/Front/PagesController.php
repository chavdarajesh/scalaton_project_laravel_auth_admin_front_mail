<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Faqs;
use App\Models\Blog;

class PagesController extends Controller
{
    //

    public function home()
    {
        return view('front.pages.home');
    }
    public function about()
    {
        return view('front.pages.about');
    }
    public function services()
    {
        return view('front.pages.services');
    }
    public function term_and_condition()
    {
        return view('front.pages.term_and_condition');
    }
    public function privacy_policy()
    {
        return view('front.pages.privacy_policy');
    }
    public function faqs()
    {
        $Faqs = Faqs::where('status', 1)->get();
        return view('front.faqs.view', ['Faqs' => $Faqs]);
    }
    public function blog()
    {
        $Blogs = Blog::where('status', 1)->get();
        return view('front.blogs.blogs_list', ['Blogs' => $Blogs]);
    }

    public function blog_details($id)
    {
        if ($id) {
            $Blog = Blog::find($id);
            if ($Blog) {
                return view('front.blogs.blog_details', ['Blog' => $Blog]);
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..!');
            }
        } else {
            return redirect()->back()->with('error', 'Blog Not Found..!');
        }
    }
}
