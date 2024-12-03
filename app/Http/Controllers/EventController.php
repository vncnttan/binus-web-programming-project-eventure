<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
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

    public function find(Request $request)
    {
        $searchQuery = $request->input('query', '');

        $events = Event::withCount('attendees');

        if (!empty($searchQuery)) {
            $events->where('name', 'LIKE', "%{$searchQuery}%");
        }

        if ($request->filled('category')) {
            $events->where('category_id', $request->input('category'));
        }

        if ($request->filled('start_date')) {
            $events->where('date', '>=', $request->input('start_date'));
        }
        if ($request->filled('end_date')) {
            $events->where('date', '<=', $request->input('end_date'));
        }

        $sort = $request->input('sort', 'date');
        $order = $request->input('ordering', 'asc');

        if ($sort === 'date') {
            $events->orderBy('date', $order);
        } elseif ($sort === 'popularity') {
            $events->orderBy('attendees_count', $order);
        }

        $events = $events->paginate(9);

        $categories = Category::all();

        return view('homepage.find', compact('events', 'searchQuery', 'categories'));
    }
}
