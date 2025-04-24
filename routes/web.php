<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

//these should be accessed by anyone without prompt for login
Route::get('/', [HomeController::class, 'index'])->name('home'); // homepage
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submit'])->name('contact.submit');
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/music', [HomeController::class, 'music'])->name('music');
Route::get('music/{slug}', [HomeController::class, 'musicShow'])->name('music.show');
Route::get('/download/{id}', [HomeController::class, 'downloadTrack'])->name('music.download');
Route::get('music/play/{slug}', [MusicController::class, 'trackPlay'])->name('music.trackPlay');



Route::get('artists/create', [ArtistController::class, 'create'])->name('artists.create');
Route::post('artists', [ArtistController::class, 'store'])->name('artists.store');

// Auth routes (login, register, etc.)
// Public Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset']);

//require auth from here below
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

// Admin Music Routes - Requires Auth
Route::middleware('auth')->prefix('admin/music')->name('music.')->group(function () {
    // Route to view all songs and albums
    Route::get('/', [MusicController::class, 'index'])->name('index');

    // Route to create a new song or album
    Route::get('create', [MusicController::class, 'create'])->name('create');

    // Route to store a new song or album
    Route::post('store', [MusicController::class, 'store'])->name('store');

    // Route to edit a song or album
    Route::get('{id}/edit', [MusicController::class, 'edit'])->name('edit');

    // Route to update a song or album
    Route::put('{id}', [MusicController::class, 'update'])->name('update');

    // Route to delete a song or album
    Route::delete('{id}', [MusicController::class, 'destroy'])->name('destroy');
});
