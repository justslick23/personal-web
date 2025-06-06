<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;

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
Route::get('song/{slug}', [HomeController::class, 'musicShow'])->name('music.show');
Route::get('/download/{slug}', [HomeController::class, 'downloadTrack'])->name('music.download');
Route::get('music/play/{id}', [HomeController::class, 'trackPlay'])->name('music.trackPlay');
Route::get('/albums/{slug}', [HomeController::class, 'showAlbum'])->name('albums.view');

Route::get('/music/album/{slug}/download', [HomeController::class, 'downloadAlbum'])->name('album.download');


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
    Route::get('{id}/image', [PortfolioController::class, 'serveImage'])->name('image');
    Route::get('{id}/show', [PortfolioController::class, 'show'])->name('show'); // Add this

});

Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');

// Add this route to your web.php temporarily
Route::get('/debug-b2', function () {
    try {
        $config = config('filesystems.disks.b2');

        // Correct keys to check
        $requiredKeys = ['key', 'secret', 'region', 'bucket', 'endpoint'];
        $missing = [];

        foreach ($requiredKeys as $key) {
            if (empty($config[$key])) {
                $missing[] = $key;
            }
        }

        if (!empty($missing)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Missing B2 configuration',
                'missing_keys' => $missing,
                'config' => array_map(fn ($v) => $v ? 'SET' : 'MISSING', $config),
            ]);
        }

        // Try to upload a test file
        $disk = Storage::disk('b2');
        $testFile = 'debug/test-b2-' . Str::random(6) . '.txt';
        $disk->put($testFile, 'Backblaze B2 test successful at ' . now());

        // Clean up after 5 seconds delay (if needed)
        $disk->delete($testFile);

        return response()->json([
            'status' => 'success',
            'message' => 'B2 connection working and file upload successful!',
            'disk' => $disk->url($testFile) ?? 'No public URL available (private bucket)',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'B2 connection failed',
            'error' => $e->getMessage(),
        ]);
    }
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
    
    // Route to view a song
    Route::get('{slug}', [MusicController::class, 'display'])->name('songs.view');

    // Route to view an album
    Route::get('album/{slug}', [MusicController::class, 'showAlbum'])->name('album.view');

    // Route to delete a song or album
    Route::delete('{id}', [MusicController::class, 'destroy'])->name('destroy');
});

Route::get('/test-b2-connection', [PortfolioController::class, 'testB2Connection']);
