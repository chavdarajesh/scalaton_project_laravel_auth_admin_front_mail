<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Front\Contact;
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

        $Contact = new Contact();
        $Contact->name = $request['name'];
        $Contact->email = $request['email'];
        $Contact->subject = $request['subject'];
        $Contact->message = $request['message'];
        $Contact->save();

        if ($Contact) {
                return redirect()->route('front.contactpage')->with('message', 'Your message has been sent. Thank you!..');
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }
}
