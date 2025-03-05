<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/mentorjur', function () {
    return view('user.mentorjur');
})->name('mentorjur');

Route::get('/profil', function () {
    return view('user.profil');
})->name('profil');

Route::get('/profilC', function () {
    return view('class.class');
})->name('profilC');

Route::get('/profilT', function () {
    return view('class.transaksi');
})->name('profilT');

Route::get('/profilA', function () {
    return view('class.appreciate');
})->name('profilA');

Route::get('/jur', function () {
    return view('user.class-jur');
})->name('jur');


Route::get('/editprof', function () {return view('class.editprof');})->name('editprof');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/dtdiri', function () {return view('class.dtdiri');})->name('dtdiri');
Route::put('/profile/updatedtr', [ProfileController::class, 'updatedtr'])->name('profile.updatedtr');


Route::get('/profileU', [ProfileController::class, 'profile'])->name('user.profileU');



Route::get('/download/{filename}', function ($filename) {
    $path = public_path('images/' . $filename);

    if (!file_exists($path)) {
        abort(404); 
    }
    return response()->download($path);
})->name('download.image');

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