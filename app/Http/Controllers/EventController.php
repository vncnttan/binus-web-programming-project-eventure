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
            ->take(5)
            ->get();
        return view('homepage.index', compact('trendingEvents'));
    }
}
