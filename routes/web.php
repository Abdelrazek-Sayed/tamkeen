<?php

use App\Http\Controllers\Auth\Socials\GoogleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return view('welcome');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
//        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
//       return redirect()->route('posts');
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




    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });



});


require __DIR__ . '/auth.php';

