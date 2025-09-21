<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MoodController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $moods = auth()->user()->moods()->orderBy('date', 'desc')->get();
        return view('dashboard', ['moods' => $moods]);
    })->name('dashboard');

    Route::get('/moods/create', [MoodController::class, 'create'])->name('moods.create');
    Route::post('/moods', [MoodController::class, 'store'])->name('moods.store');
});
