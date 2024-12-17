<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Attendee;

class AttendeeController extends Controller
{
    public function index(Event $event)
    {
        $attendees = Attendee::where('event_id', $event->id)->paginate(20);
        $event->load('attendees')->loadCount('attendees');
        return view('events.attendees', compact('attendees', 'event'));
    }
}
