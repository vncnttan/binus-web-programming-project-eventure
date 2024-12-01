<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    public function index()
    {
        $trendingEvents = Event::withCount('attendees')
            ->orderBy('attendees_count', 'desc')
            ->take(4)
            ->get();

        $recentEvents = Event::withCount('attendees')
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('homepage.index', compact('trendingEvents', 'recentEvents'));
    }

    public function show(Event $event)
    {
        $event->load('attendees')->loadCount('attendees');

        return view('events.show', compact('event'));
    }
}
