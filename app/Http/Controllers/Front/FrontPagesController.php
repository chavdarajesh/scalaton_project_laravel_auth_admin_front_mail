<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Faqs;
use App\Models\Blog;
use Illuminate\Http\Request;

class FrontPagesController extends Controller
{
    //

    public function homepage()
    {
        return view('front.pages.home');
    }
    public function aboutpage()
    {
        return view('front.pages.about');
    }
    public function servicespage()
    {
        return view('front.pages.services');
    }
    public function term_and_conditionpage()
    {
        return view('front.pages.term_and_condition');
    }
    public function privacy_policypage()
    {
        return view('front.pages.privacy_policy');
    }
    public function faqspage()
    {
        $Faqs=Faqs::where('status',1)->get();
        return view('front.faqs.view',['Faqs'=>$Faqs]);
    }
    public function blogpage()
    {
        $Blogs=Blog::where('status',1)->get();
        return view('front.blogs.blogs_list',['Blogs'=>$Blogs]);
    }

    public function blog_details($id)
    {
        if ($id) {
            $Blog = Blog::find($id);
            if ($Blog) {
                return view('front.blogs.blog_details',['Blog'=>$Blog]);
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..!');
            }
        } else {
            return redirect()->back()->with('error', 'Blog Not Found..!');
        }
    }
}
