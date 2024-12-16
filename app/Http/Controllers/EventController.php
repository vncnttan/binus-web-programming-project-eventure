<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Category;
use App\Models\Attendee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
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
        $role = "attendee";
        $user = Auth::user();
        if($user->id === $event->user_id) {
            $role = "admin";
        }

        $event->load('attendees')->loadCount('attendees');

        return view('events.show', compact('event', 'role'));
    }

    public function join(Request $request) {
        $request->validate([
            'attendees' => 'required|array|min:1',
            'attendees.*.name' => 'required|string|max:255',
            'attendees.*.email' => 'required|email|max:255',
            'attendees.*.phone' => 'required|string|max:15',
        ]);

        try {
            foreach ($request->attendees as $attendee) {
                Attendee::create([
                    'full_name' => $attendee['full_name'],
                    'email' => $attendee['email'],
                    'phone_number' => $attendee['phone_number'],
                    'event_id' => $request->event_id,
                ]);
            }
            return redirect()->route('events.index')
                ->with('success', 'Attendees have been successfully added.');
                
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong while adding attendees. Please try again.')
                ->withInput();
        }
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

    public function edit(Event $event)
    {
        $categories = Category::all();

        return view('events.edit', compact('event', 'categories'));
    }

    public function add()
    {
        $categories = Category::all();

        return view('events.add', compact('categories'));
    }

    public function store(Request $request, User $user)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'category_id' => 'required|exists:categories,id',
        //     'date' => 'required|date',
        //     'start_time' => 'required|date_format:H:i',
        //     'end_time' => 'required|date_format:H:i',
        //     'quota' => 'required|integer|min:1',
        //     'max_per_account' => 'required|integer|min:1',
        //     'is_online' => 'required|boolean',
        //     'location' => 'nullable|string|max:255',
        //     'description' => 'nullable|string',
        //     'banner_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        // ]);

        $photoPath = null;
        $user = Auth::user();
        if ($request->hasFile('banner_image')) {
            $photo = $request->file('banner_image');
            $path = Storage::disk('s3')->put("images", $photo);
            $photoPath = Storage::disk('s3')->url($path);
        }

        $event = new Event();
        $event->name = $request->name;
        $event->category_id = $request->category_id;
        $event->date = $request->date;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->quota = $request->quota;
        $event->max_per_account = $request->max_per_account;
        $event->user_id= $user->id;
        $event->is_online = $request->is_online;
        $event->location = $request->location;
        $event->description = $request->description;
        $event->banner_image = $photoPath;

        $user->events()->save($event);

        return redirect()->route('index')->with('success', 'Event created successfully.');
    }

    public function update(Request $request, Event $event)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'category_id' => 'required|exists:categories,id',
        //     'date' => 'required|date',
        //     'start_time' => 'required|date_format:H:i',
        //     'end_time' => 'required|date_format:H:i',
        //     'quota' => 'required|integer|min:1',
        //     'max_per_account' => 'required|integer|min:1',
        //     'is_online' => 'required|boolean',
        //     'location' => 'nullable|string|max:255',
        //     'description' => 'nullable|string',
        //     'banner_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        // ]);

        $photoPath = "";

        if ($request->hasFile('banner_image')) {
            $photo = $request->file('banner_image');
            $destinationPath = 'storage';
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path($destinationPath)."/Event", $photoName);
            $photoPath = storage_asset('/Event/' . $photoName) ;
        }

        $event->name = $request->name;
        $event->category_id = $request->category_id;
        $event->date = $request->date;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->quota = $request->quota;
        $event->max_per_account = $request->max_per_account;
        $event->is_online = $request->is_online;
        $event->location = $request->location;
        $event->description = $request->description;
        $event->banner_image = $photoPath;

        $event->save();


        return redirect()->route('event.show', $event)->with('success', 'Event updated successfully.');
    }
}
