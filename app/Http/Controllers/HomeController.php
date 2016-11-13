<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reminder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('subscribed');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function show()
    {
        $reminders = Reminder::where('user_id', \Auth::user()->id)->get();

        foreach($reminders as $reminder) {
            if($reminder->date == date('Y-m-d')){
                $rem = Reminder::find($reminder->id);
                $rem->reminder_status_id = 2;
            } else if($reminder->date > date('Y-m-d')) {
                $rem = Reminder::find($reminder->id);
                $rem->reminder_status_id = 3;
                $rem->save();
            } else {
                $rem = Reminder::find($reminder->id);
                $rem->reminder_status_id = 4;
                $rem->save();
            }

            $rem->save();
        }

        return view('home');
    }
}
