<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Front\ContactMessage;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Concat;
use App\Models\Admin\ContactSetting;

class ContactController extends Controller
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
            $totalRecords = ContactMessage::select('count(*) as allcount')->count();
            $totalRecordswithFilter =
                ContactMessage::select('count(*) as allcount')
                ->where('id', 'like', '%' . $searchValue . '%')
                ->orWhere('name', 'like', '%' . $searchValue . '%')
                ->orWhere('email', 'like', '%' . $searchValue . '%')
                ->orWhere('subject', 'like', '%' . $searchValue . '%')
                ->orWhere('message', 'like', '%' . $searchValue . '%')
                ->count();

            // Get records, also we have included search filter as well
            $records = ContactMessage::where('id', 'like', '%' . $searchValue . '%')
                ->orWhere('name', 'like', '%' . $searchValue . '%')
                ->orWhere('email', 'like', '%' . $searchValue . '%')
                ->orWhere('subject', 'like', '%' . $searchValue . '%')
                ->orWhere('message', 'like', '%' . $searchValue . '%')

                ->orderBy($columnName, $columnSortOrder)
                ->select('*')
                ->skip($start)
                ->take($rowperpage)
                ->get();

            $data_arr = array();

            foreach ($records as $row) {
                $html = '<a href="' . route("admin.contact.messages.view", $row->id) . '"> <button type="button"
                            class="btn btn-icon btn-outline-info">
                            <i class="bx bx-show"></i>
                        </button></a>
                    <button type="button" class="btn btn-icon btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#delete-modal-' . $row->id . '">
                        <i class="bx bx-trash-alt"></i>
                    </button>
                    <div class="modal fade" id="delete-modal-' . $row->id . '"
                        tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <form action="' . route("admin.contact.messages.delete", $row->id) . '"
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
                    "name" => $row->name,
                    "email" => $row->email,
                    "subject" => strlen($row->subject) > 25 ? substr($row->subject, 0, 25) . '..' : $row->subject,
                    "message" => strlen($row->message) > 25 ? substr($row->message, 0, 25) . '..' : $row->message,
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
            return view('admin.contact.messages.index');
        }
    }

    public function delete($id)
    {
        if ($id) {
            $ContactMessage = ContactMessage::find($id);
            $ContactMessage = $ContactMessage->delete();
            if ($ContactMessage) {
                return redirect()->route('admin.contact.messages.index')->with('message', 'Contact Message Deleted Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..!');
            }
        } else {
            return redirect()->back()->with('error', 'Contact Message Not Found..!');
        }
    }

    public function view($id)
    {
        $ContactMessage = ContactMessage::find($id);
        if ($ContactMessage) {
            return view('admin.contact.messages.view', ['ContactMessage' => $ContactMessage]);
        } else {
            return redirect()->back()->with('error', 'Contact Message Not Found..!');
        }
    }

    public function indexContactSettings()
    {
        $ContactSetting = ContactSetting::where('static_id', 1)->where('status', 1)->first();
        return view('admin.contact.settings.index', ['ContactSetting' => $ContactSetting]);
    }
    public function saveContactSettings(Request $request)
    {
        $request->validate([
            'email' => 'email',
            'phone' => 'min:10',
        ]);

        $ContactSetting = ContactSetting::find($request->id);
        $ContactSetting->email = $request['email'];
        $ContactSetting->phone = $request['phone'];
        $ContactSetting->location = $request['location'];
        $ContactSetting->map_iframe = $request['map_iframe'];
        $ContactSetting->timing = $request['timing'];
        $ContactSetting->update();
        if ($ContactSetting) {
            return redirect()->route('admin.contact.settings.index')->with('message', 'ContactSetting Saved Sucssesfully..');
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }
}
