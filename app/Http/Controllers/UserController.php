<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(): Factory|View|Application
    {
        return view('auth.login');
    }

    public function register(): Factory|View|Application
    {
        return view('auth.register');
    }

    public function registerUser(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'username' => 'required|string|min:4|max:20',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|numeric|starts_with:0|digits_between:10,12',
        ]);

        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->phone_number = $request->phone_number;
        $user->email_verified_at = now();
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(10);
        $user->save();

        return redirect()->route('login')->with('success', 'User registered successfully');
    }

    public function loginUser(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->route('login')->with('error', 'Invalid credentials');
        }

        $request->session()->put('user', $user);

        return redirect()->route('index')->with('success', 'Logged in successfully');
    }
}
