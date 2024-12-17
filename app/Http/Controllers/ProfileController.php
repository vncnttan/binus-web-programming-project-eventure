<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    public function view()
    {
        $user = Auth::user();
        $events = collect();
        if (Gate::allows('organizer-privilege', $user)) {
            $events = Event::where('user_id', $user->id)->paginate(8);
        }
        if (Gate::allows('participant-privilege')) {
            $attendeeEvents = Attendee::where('email', $user->email)->pluck('event_id');
            $participantEvents = Event::whereIn('id', $attendeeEvents)->paginate(8);
            $events = $events->merge($participantEvents);
        }
        $events->load('attendees')->loadCount('attendees');
        return view('profile.view', compact('user', 'events'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'date_of_birth' => 'nullable|date',
            'phone_number' => 'nullable|string|max:15',
            'image' => 'nullable|image|max:2048',
        ]);

        // if ($request->hasFile('image')) {
        //     // Store new image without deleting the old one
        //     $user->image = $request->file('image')->store('profile-pictures', 'public');
        // }

        $photoPath = "";

        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $destinationPath = 'storage';
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path($destinationPath)."/Profile", $photoName);
            $photoPath = storage_asset('/Profile/' . $photoName) ;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->phone_number = $request->phone_number;
        $user->image = $photoPath;
        $user->save();

        // Redirect back with a success message
        return redirect()->route('profile.view')->with('success', 'Profile updated successfully!');
    }
}
