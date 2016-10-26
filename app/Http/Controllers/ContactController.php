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
        if(!empty($request->phone)){
            $request->phone = (int)preg_replace("/[^0-9]/", "", $request->phone);
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'company' => 'min:5|regex:/^[a-z0-9 .\-]+$/i',
            'address1' => 'min:5|regex:/^[a-z0-9 .\-]+$/i',
            'address2' => 'min:5|regex:/^[a-z0-9 .\-]+$/i',
            'city' => 'min:3|alpha_num',
            'state' => 'min:2|alpha',
            'zip' => 'min:5|numeric'
        ]);

        if(!empty($request->get('id'))){
            $contact = Contact::find($request->get('id'));
        } else {
            $contact = new Contact;
        }

        foreach($contact->getFillable() as $field){
            if(!empty($request->get($field))){
                $contact->{$field} = $request->get($field);
            }
        }
        $contact->user_id = $request->user()->id;
        $contact->team_id = $request->user()->current_team_id;
        $contact->save();

        return json_encode(array('success' => true));
    }

    public function search($term, Request $request)
    {
        $user_id = $request->user()->id;
        $team_id = $request->user()->current_team_id;
        $user_results = Contact::search($term)->where('user_id', $user_id)->get();
        $team_results = Contact::search($term)->where('public', 1)->where('team_id', $team_id)->get();

        $results = $user_results;
        foreach($team_results as $result){
            if($result->user_id != $user_id){
                $results[] = $result;
            }
        }

        return view('contact.index')->with('contacts', $results);
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
        $contents = Excel::load('storage/app/' . $file, function($reader) {})->get();
        foreach($contents as $content){
            $contact = new Contact;

            foreach($contact->getFillable() as $field){
                if($content->get($field) !== null){
                    $contact->{$field} = $content->get($field);
                }
            }

            $contact->user_id = $request->user()->id;
            $contact->team_id = $request->user()->current_team_id;
            $contact->save();
        }
    }

    public function index(Request $request)
    {
        $contacts = Contact::where('team_id', $request->user()->current_team_id)
            ->where('public', 1)
            ->orWhere('user_id',$request->user()->id)
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
        $contacts = Contact::where('public', 1)
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
