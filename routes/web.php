<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MovieController::class, 'index'])->name('show-home');

Route::get('/movie/{movie:show_id}', [MovieController::class, 'show'])->name('show-movie');

Route::get('/login', [Auth\LoginController::class, 'index'])->name('show-login');
Route::post('/login', [Auth\LoginController::class, 'login'])->name('login');

Route::get('/register', [Auth\RegisterController::class, 'index'])->name('show-register');
Route::post('/register', [Auth\RegisterController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {
    Route::delete('/api/addWatchlist/{movie:show_id}', [WatchListController::class, 'destroy'])->name('delete-watchlist');
    Route::post('/api/addWatchlist/{movie:show_id}', [WatchListController::class, 'store'])->name('store-watchlist');
    Route::get('/profile', [UserController::class, 'index'])->name('show-profile');
    Route::put('/profile', [UserController::class, 'update'])->name('update-profile');
    Route::post('review/{movie:show_id}', [ReviewController::class, 'store'])->name('store-review');
    Route::delete('review/{movie:show_id}', [ReviewController::class, 'destroy'])->name('delete-review');
    Route::get('/logout', [Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('/watchlist', [WatchListController::class, 'index'])->name('show-watchlist');
    Route::post('/watchlist/{movie:show_id}/{page}', [WatchListController::class, 'action'])->name('action-watchlist');
});
