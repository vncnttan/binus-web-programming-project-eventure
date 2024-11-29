<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(\App\Http\Middleware\GuestAuthenticate::class)->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'registerUser'])->name('register.user');
    Route::post('/login', [UserController::class, 'loginUser'])->name('login.user');
});

Route::get('/choose-role', [UserController::class, 'chooseRole'])->name('choose-role');
Route::post('/choose-role', [UserController::class, 'chooseRoleUser'])->name('choose-role.user');

Route::middleware(\App\Http\Middleware\Authenticate::class)->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
});

