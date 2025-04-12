<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\HomeController;

// Public HomeController routes
Route::get('/', [HomeController::class, 'index'])->name('home'); // optional if homepage is at /
Route::get('/home', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', function () {
    // Handle contact form submission here
    return redirect()->back()->with('success', 'Your message has been sent!');
})->name('contact.submit');
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio');

Route::get('/music', [HomeController::class, 'music'])->name('music');
Route::get('/music/{id}', [HomeController::class, 'musicShow'])->name('music.show');

// Auth routes (login, register, etc.)
Auth::routes();

// Dashboard - Requires Auth
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes - Requires Auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Portfolio Routes - Requires Auth
Route::middleware('auth')->prefix('admin/portfolio')->name('portfolio.')->group(function () {
    Route::get('/', [PortfolioController::class, 'index'])->name('index');
    Route::get('create', [PortfolioController::class, 'create'])->name('create');
    Route::post('store', [PortfolioController::class, 'store'])->name('store');
    Route::get('{id}/edit', [PortfolioController::class, 'edit'])->name('edit');
    Route::put('{id}', [PortfolioController::class, 'update'])->name('update');
    Route::delete('{id}', [PortfolioController::class, 'destroy'])->name('destroy');
});
