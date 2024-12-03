<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\EnsureRoleNotFilled;
use App\Http\Middleware\EnsureRoleValid;
use App\Http\Middleware\GuestAuthenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(GuestAuthenticate::class)->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'registerUser'])->name('register.user');
    Route::post('/login', [UserController::class, 'loginUser'])->name('login.user');
});

Route::middleware([Authenticate::class, EnsureRoleNotFilled::class])->group(function () {
    Route::get('/choose-role', [UserController::class, 'chooseRole'])->name('choose-role');
    Route::post('/choose-role', [UserController::class, 'chooseRoleUser'])->name('choose-role.user');
});

Route::middleware([Authenticate::class, EnsureRoleValid::class])->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/event/{event}', [EventController::class, 'show'])->name('event.show');
    Route::get('/profile', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/find-events', [EventController::class, 'find'])->name('find');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::get('/events/add', [EventController::class, 'add'])->name('events.add');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::post('/events/store', [EventController::class, 'store'])->name('event.store');
});

