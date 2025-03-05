<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\navbarController;

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

Route::get('/classuniversal', function () {
    return view('user.classuniversal');
})->name('classuniversal');

Route::get('/buypremium', function () {
    return view('user.buypremium');
})->name('buypremium');
