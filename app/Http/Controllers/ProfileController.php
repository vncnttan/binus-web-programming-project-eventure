<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ProfileController extends Controller
{
    public function view()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('profile.view', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'date_of_birth' => 'nullable|date',
            'phone_number' => 'nullable|string|max:15',
            'image' => 'nullable|image|max:2048', // Ensure image is valid and under 2MB
        ]);

        // Update user data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->phone_number = $request->phone_number;

        // Handle profile picture upload
        if ($request->hasFile('image')) {
            // Store new image without deleting the old one
            $user->image = $request->file('image')->store('profile-pictures', 'public');
        }

        // Save updated user
        $user->save();

        // Redirect back with a success message
        return redirect()->route('profile.view')->with('success', 'Profile updated successfully!');
    }
}
