<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;

Route::get('/home', function () {
    return view('user.landingpage');
})->name('home');

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\OauthController;
use App\Http\Controllers\SeeController;
use App\Http\Controllers\transaksicontroller;
use App\Http\Middleware\AdminMiddleware;


Route::get('/class', function () {
    return view('user.class');
})->name('class');



Route::get('/mentorjur', function () {
    return view('user.mentorjur');
})->name('mentorjur');

Route::get('/profil', function () {
    return view('user.profil');
})->name('profil');

Route::get('/classuniversal', function () {
    return view('user.classuniversal');
})->name('classuniversal');

Route::get('/buypremium', function () {
    return view('user.buypremium');
})->name('buypremium');

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
Route::get('/univ', function () {
    return view('user.class-univ');
})->name('univ');

Route::middleware(['auth'])->group(function () {
    Route::post('/pay', [MidtransController::class, 'pay'])->name('pay');
});

Route::post('/payment/callback', [PaymentController::class, 'handleCallback']);

Route::get('/editprof', function () {return view('class.editprof');})->name('editprof');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/dtdiri', function () {return view('class.dtdiri');})->name('dtdiri');
Route::put('/profile/updatedtr', [ProfileController::class, 'updatedtr'])->name('profile.updatedtr');

Route::get('/profileU', [ProfileController::class, 'profile'])->name('user.profileU');

Route::get('/mentor', [SeeController::class, 'seeMen'])->name('mentor');



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
    Route::get('/', function () {
        return view('user.landingpage');
    })->name('home');
});


Route::get('oauth/google', [\App\Http\Controllers\OauthController::class, 'redirectToProvider'])->name('oauth.google');  
Route::get('oauth/google/callback', [\App\Http\Controllers\OauthController::class, 'handleProviderCallback'])->name('oauth.google.callback');


Route::get('oauth/google', [\App\Http\Controllers\OauthController::class, 'redirectToProvider'])->name('oauth.google');
Route::get('oauth/google/callback', [\App\Http\Controllers\OauthController::class, 'handleProviderCallback'])->name('oauth.google.callback');

Route::post('/login', [OauthController::class, 'loginManual'])->name('login');
Route::post('/logout', [OauthController::class, 'logout'])->name('logout');

// Middleware Admin
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/datauser', [AdminController::class, 'dataUser'])->name('admin.user');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');

    Route::get('/datamentor', [AdminController::class, 'dataMentor'])->name('admin.mentor');
    Route::get('/mentor/create', [AdminController::class, 'createMentor'])->name('mentor.create');
    Route::post('/mentor/store', [AdminController::class, 'storeMentor'])->name('mentor.store');
    Route::get('/mentor/edit/{id}', [AdminController::class, 'editMentor'])->name('mentor.edit');
    Route::put('/mntr/edit/{id}', [AdminController::class, 'updateMentor'])->name('mentor.update');
    Route::delete('/mentor/{id}', [AdminController::class, 'mentorDestroy'])->name('mentor.destroy');

    Route::get('/datatransaksi', function () { return view('admin.transaksi'); })->name('admin.transaksi');

    Route::get('/manageM', function () { return view('admin.materi.manageM'); })->name('admin.manage');
    Route::get('/editV', function () { return view('admin.materi.editV'); })->name('admin.editV');
    Route::get('/tambahV', function () { return view('admin.materi.tambahV'); })->name('admin.tambahV');
    Route::get('/addM', function () { return view('admin.materi.addM'); })->name('admin.addM');

    
    Route::get('/editM/{id}', [AdminController::class, 'editCover'])->name('admin.editM');
    Route::put('/editM/update/{id}', [AdminController::class, 'updateM'])->name('admin.updateM');
    Route::delete('/deleteM/{id}', [AdminController::class, 'deleteM'])->name('admin.deleteM');
    
    Route::get('/video/create/{id}', [AdminController::class, 'createMateri'])->name('video');
    Route::post('/createV/{id}', [AdminController::class, 'storeMateri'])->name('materi.store');
    Route::get('/editV/{id}', [AdminController::class, 'editV'])->name('admin.editV');
    Route::put('/editV/update/{id}', [AdminController::class, 'updateV'])->name('materi.updateV');
    Route::delete('/deleteV/{id}', [AdminController::class, 'deleteV'])->name('materi.deleteV');
    Route::delete('/deleteC/{id}', [AdminController::class, 'deleteCover'])->name('cover.delete');

    Route::get('/Materi/create', [AdminController::class, 'createCover'])->name('cover.create');
    Route::post('/createM', [AdminController::class, 'storeCover'])->name('cover.store');

    Route::get('/datamateri', [AdminController::class, 'dataCover'])->name('admin.cover');
    Route::get('/manageM/{id}', [AdminController::class, 'dataMateri'])->name('admin.materi');


    Route::get('/dataquiz', function () { return view('admin.quiz.data'); })->name('admin.quiz');
});
