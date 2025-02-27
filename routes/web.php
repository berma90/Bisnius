<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\navbarController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('user.landingpage');
})->name('home');

Route::get('/class', function () {
    return view('user.class');
})->name('class');

Route::get('/mentor', function () {
    return view('user.mentor');
})->name('mentor');

Route::get('/profil', function () {
    return view('user.profil');
})->name('profil');

Route::get('/profileU', [ProfileController::class, 'profile'])->name('user.profileU');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.landingpage');
    })->name('dashboard');
});

Route::get('oauth/google', [\App\Http\Controllers\OauthController::class, 'redirectToProvider'])->name('oauth.google');  
Route::get('oauth/google/callback', [\App\Http\Controllers\OauthController::class, 'handleProviderCallback'])->name('oauth.google.callback');