<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OauthController;
use App\Http\Middleware\AdminMiddleware;

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
    Route::get('/', function () {
        return view('user.landingpage');
    })->name('home');
});

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
    Route::get('/editM', function () { return view('admin.materi.editM'); })->name('admin.editM');
    Route::get('/editV', function () { return view('admin.materi.editV'); })->name('admin.editV');
    Route::get('/tambahV', function () { return view('admin.materi.tambahV'); })->name('admin.tambahV');
    Route::get('/addM', function () { return view('admin.materi.addM'); })->name('admin.addM');

    Route::get('/video/create', [AdminController::class, 'tmbhV'])->name('video');
    Route::post('/createV', [AdminController::class, 'createV'])->name('Cmateri.video');


    Route::get('/Materi/create', [AdminController::class, 'tmbhM'])->name('Materi');
    Route::post('/createM', [AdminController::class, 'createM'])->name('Ccover');

    Route::get('/datamateri', [AdminController::class, 'indexi'])->name('admin.materi');
    Route::get('/manageM/{id}', [AdminController::class, 'indexii'])->name('admin.manageM');


    Route::get('/dataquiz', function () { return view('admin.quiz.data'); })->name('admin.quiz');
});
