<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function view()
    {
        $user = Auth::user();
        return view('profile.view', compact('user'));
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
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|string|max:15',
            'image' => 'nullable|image|max:2048',
        ]);
        
        $user = Auth::user();
        $photoPath = $user->image;
        if ($request->hasFile('profile_image')) {
            $photo = $request->file('profile_image');
            $path = Storage::disk('s3')->put("images", $photo);
            $photoPath = Storage::disk('s3')->url($path);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->phone_number = $request->phone_number;
        $user->image = $photoPath;
        $user->save();

        return redirect()->route('profile.view')->with('success', 'Profile updated successfully!');
    }
}
