<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Contact;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    public function add(Request $request)
    {
        $contact = new Contact;
        $contact->name = $request->get('name');
        $contact->phone = $request->get('phone');
        $contact->email = $request->get('email');
        $contact->user_id = $request->user()->id;
        $contact->team_id = $request->user()->current_team_id;
        $contact->save();

        return json_encode(array('success' => true));
    }

    public function import(Request $request)
    {
        $file = $request['photo'];
        $res = $file->store('uploads/contacts/' . $request->user()->current_team_id);
        $this->_parser($res, $request);
        return json_encode(array('success' => $res));
    }

    private function _parser($file, Request $request)
    {
        $contents = Excel::load('storage/app/' . $file, function($reader) {

        })->get();
        foreach($contents as $content){
            $contact = new Contact;
            $contact->name = $content->get('name');
            $contact->phone = $content->get('phone');
            $contact->email = $content->get('email');
            $contact->user_id = $request->user()->id;
            $contact->team_id = $request->user()->current_team_id;
            $contact->save();
        }
    }

    public function index(Request $request)
    {
        $contacts = Contact::where('user_id', $request->user()->id)
            ->where('team_id', $request->user()->current_team_id)
            ->orderBy('name', 'desc')
            ->get();

        return view('contact.index')->with('contacts', $contacts);
    }

    public function view($id)
    {
        $contact = Contact::where('id', $id)->first();
        return view('contact.view')->with('contact',$contact);
    }

    public function privacy_toggle($id)
    {
        $contact = Contact::find($id);
        $contact->public = !$contact->public;
        $contact->save();
        return redirect()->back();
    }

    public function delete($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->back();
    }

    public function export(Request $request)
    {
        $type = $request->get('type');
        $contacts = Contact::where('user_id', $request->user()->id)
            ->where('team_id', $request->user()->current_team_id)
            ->orderBy('name', 'desc')
            ->get();

        $res = Excel::create($request->user()->current_team_id . '_' . str_random(40) . '_export', function($excel) use($contacts) {
            $excel->sheet('All', function($sheet) use($contacts) {
                $sheet->fromArray($contacts);
            });
        })->store($type);
        return $res['file'];
    }
}
