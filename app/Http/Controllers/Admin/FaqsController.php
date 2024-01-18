<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Faqs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqsController extends Controller
{
    //
    public function get_faqs()
    {
        $Faqs = Faqs::all();
        return view('admin.faqs.faqs_index', ['Faqs' => $Faqs]);
    }
    public function get_faqs_add()
    {
        return view('admin.faqs.faq_add');
    }
    public function post_faqs(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $Faqs = new Faqs();
        $Faqs->title = $request['title'];
        $Faqs->description = $request['description'];
        $Faqs->status = 1;
        $Faqs = $Faqs->save();
        if ($Faqs) {
            return redirect()->route('admin.get.faqs')->with('message', 'Faqs ADD  Sucssesfully..');
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }

    public function faqs_delete($id)
    {
        if ($id) {
            $Faqs = Faqs::find($id);
            $Faqs = $Faqs->delete();
            if ($Faqs) {
                return redirect()->route('admin.get.faqs')->with('message', 'Faqs Delete  Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..!');
            }
        } else {
            return redirect()->back()->with('error', 'Faqs Not Found..!');
        }
    }

    public function faqs_edit($id)
    {
        $Faq = Faqs::find($id);
        if ($Faq) {
            return view('admin.faqs.faq_edit', ['Faq' => $Faq]);
        } else {
            return redirect()->back()->with('error', 'Faq Not Found..!');
        }
    }
    public function faqs_view($id)
    {
        $Faq = Faqs::find($id);
        if ($Faq) {
            return view('admin.faqs.faq_view', ['Faq' => $Faq]);
        } else {
            return redirect()->back()->with('error', 'Faq Not Found..!');
        }
    }

    public function faqs_update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $Faqs = Faqs::find($request->id);
        if ($Faqs) {
            $Faqs->title = $request['title'];
            $Faqs->description = $request['description'];
            $Faqs = $Faqs->update();
            if ($Faqs) {
                return redirect()->route('admin.get.faqs')->with('message', 'Faqs Edit  Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..');
            }
        } else {
            return redirect()->back()->with('error', 'Faq Not Found..!');
        }
    }
    public function faq_status_update(Request $request)
    {
        if ($request->id) {
            $Faqs = Faqs::find($request->id);
            $Faqs->status = $request->status;
            $Faqs = $Faqs->update();
            if ($Faqs) {
                return response()->json(['success' => 'Status change successfully.']);
            } else {
                return response()->json(['error' => 'Somthing Went Wrong..!']);
            }
        } else {
            return response()->json(['error' => 'Faqs Not Found..!']);
        }
    }
}
