<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Front\ContactMessage;
use Illuminate\Http\Request;
use App\Models\Admin\ContactSetting;

class ContactController extends Controller
{
    //
    public function contactpage()
    {
        $ContactSetting = ContactSetting::where('static_id', 1)->where('status', 1)->first();
        return view('front.pages.contact',['ContactSetting'=>$ContactSetting]);
    }
    public function postcontact(Request $request)
    {
        $request->validate([
            'name' => 'required|max:40',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $ContactMessage = new ContactMessage();
        $ContactMessage->name = $request['name'];
        $ContactMessage->email = $request['email'];
        $ContactMessage->subject = $request['subject'];
        $ContactMessage->message = $request['message'];
        $ContactMessage->save();

        if ($ContactMessage) {
                return redirect()->route('front.contactpage')->with('message', 'Your message has been sent. Thank you!..');
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }
}
