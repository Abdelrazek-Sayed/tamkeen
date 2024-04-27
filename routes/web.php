<?php

use App\Http\Controllers\Auth\Socials\GoogleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('posts', [PostController::class, 'posts'])->name('posts');
    Route::get('posts/archive', [PostController::class, 'postsArchive'])->name('posts.archive');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('auth/google', [GoogleController::class, 'signInwithGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'callbackToGoogle'])->name('auth.callback');

require __DIR__ . '/auth.php';

//Route::get('posts', Post::class)->name('posts');
