<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes — Monogram Portfolio
|--------------------------------------------------------------------------
*/

/* ── Public ── */
Route::get('/',         [HomeController::class, 'index'])->name('home');
Route::get('/about',    [AboutController::class, 'index'])->name('about');
Route::get('/portfolio',[PortfolioController::class, 'index'])->name('portfolio');
Route::get('/music',    [AdminController::class, 'musicPublic'])->name('music');
Route::get('/cv',       [HomeController::class, 'downloadCv'])->name('download.cv');

/* ── Contact ── */
Route::get('/contact',  [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

/* ── Auth (Laravel built-in) ── */
Auth::routes(['register' => false]); // disable registration if you don't need it

/* ── Redirect /home → / (fixes Auth::routes default redirect) ── */
Route::get('/home', function () {
    return redirect()->route('home');
});

/* ── Admin (auth protected) ── */
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        /* Portfolio */
        Route::prefix('portfolio')->name('portfolio.')->group(function () {
            Route::get('/',                     [AdminController::class, 'portfolioIndex'])  ->name('index');
            Route::get('/create',               [AdminController::class, 'portfolioCreate']) ->name('create');
            Route::post('/',                    [AdminController::class, 'portfolioStore'])  ->name('store');
            Route::get('/{portfolioItem}/edit', [AdminController::class, 'portfolioEdit'])   ->name('edit');
            Route::put('/{portfolioItem}',      [AdminController::class, 'portfolioUpdate']) ->name('update');
            Route::delete('/{portfolioItem}',   [AdminController::class, 'portfolioDestroy'])->name('destroy');
        });

        /* Music */
        Route::prefix('music')->name('music.')->group(function () {
            Route::get('/',                    [AdminController::class, 'musicIndex'])  ->name('index');
            Route::get('/create',              [AdminController::class, 'musicCreate']) ->name('create');
            Route::post('/',                   [AdminController::class, 'musicStore'])  ->name('store');
            Route::get('/{musicRelease}/edit', [AdminController::class, 'musicEdit'])   ->name('edit');
            Route::put('/{musicRelease}',      [AdminController::class, 'musicUpdate']) ->name('update');
            Route::delete('/{musicRelease}',   [AdminController::class, 'musicDestroy'])->name('destroy');
        });

    });