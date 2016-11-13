<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Reminder;

class ReminderController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'notes' => 'required'
        ]);

        $reminder = new Reminder;

        foreach($reminder->getFillable() as $field){
            if(!empty($request->get($field))){
                $reminder->{$field} = $request->get($field);
            }
        }
        $reminder->date = date('Y-m-d', strtotime($reminder->date));
        $reminder->time = date('H:i:s', strtotime($reminder->time));
        $reminder->user_id = $request->user()->id;
        $reminder->team_id = $request->user()->current_team_id;
        $reminder->save();

        return json_encode(array('success' => true));
    }

    public function index()
    {
        $reminders = Reminder::where('user_id', \Auth::user()->id)->orderBy('date', 'desc')->orderBy('time', 'desc')->get();

        return view('reminders.index')->with('reminders', $reminders);
    }
}
