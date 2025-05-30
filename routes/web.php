<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\OauthController;
use App\Http\Controllers\SeeController;
use App\Http\Controllers\transaksicontroller;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\MentorController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Mentor;

Route::get('/', function () {
    $mentors = Mentor::with('jurusan')->inRandomOrder()->take(4)->get();
    return view('user.landingpage', compact('mentors'));
})->name('home');

Route::get('/test', function () {
    return view('user.sfwe');
})->name('mboh');

Route::get('/mentor', [MentorController::class, 'index'])->name('mentor');

Route::get('/class', [ClassController::class, 'index'])->name('user.class');
Route::get('/class/materi/{id}', [ClassController::class, 'materi'])->name('cover.show');
// Tambahkan route di web.php
Route::post('/quiz/{id}/next', [QuizController::class, 'nextSoal'])->name('quiz.next');
Route::get('/quiz/{id}/finish', [QuizController::class, 'finishQuiz'])->name('quiz.finish');
// Menampilkan soal pertama
Route::get('/quiz/{id}', [QuizController::class, 'quiz'])->name('quiz.show');
Route::post('/quiz/{id}/previous', [QuizController::class, 'previous'])->name('quiz.previous');
// Menangani submit jawaban akhir
Route::post('/quiz/{quizId}/submit', [QuizController::class, 'submitQuiz'])->name('quiz.submit');
// Menampilkan hasil quiz
Route::get('/quiz/{quizId}/result', [QuizController::class, 'quizResult'])->name('quiz.result');
Route::get('/quiz/{quizId}/reset', [QuizController::class, 'resetQuiz'])->name('quiz.reset');
Route::get('/quiz/ulangi/{id}', [QuizController::class, 'ulangiQuiz'])->name('quiz.ulangi');
Route::get('/quiz/certificate/{quizId}', [QuizController::class, 'generateCertificate'])->name('quiz.certificate');



Route::get('/mentorjur', function () {
    return view('user.mentorjur');
})->name('mentorjur');

Route::get('/profil', function () {
    return view('user.profil');
})->name('profil');


Route::get('/buypremium', function () {
    return view('user.buypremium');
})->name('buypremium');

Route::middleware(['auth'])->group(function () {
    Route::post('/pay', [MidtransController::class, 'pay'])->name('pay');
});

Route::post('/payment/callback', [PaymentController::class, 'handleCallback']);



    Route::get('/editprof', function () {return view('class.editprof');})->name('editprof');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/dtdiri', function () {return view('class.dtdiri');})->name('dtdiri');
    Route::put('/profile/updatedtr', [ProfileController::class, 'updatedtr'])->name('profile.updatedtr');


Route::get('/profile', [ProfileController::class, 'profile'])->name('user.profile');
Route::get('/profile/class', [ProfileController::class, 'classHistory'])->name('profilC');
Route::get('/profile/transaction', [ProfileController::class, 'transactionHistory'])->name('profilT');
Route::get('/profile/appreciate', [ProfileController::class, 'appreciateHistory'])->name('profilA');

// Route::get('/profilC', function () {
//     return view('class.class');
// })->name('profilC');

// Route::get('/profilT', function () {
//     return view('class.transaksi');
// })->name('profilT');

// Route::get('/profilA', function () {
//     return view('class.appreciate');
// })->name('profilA');



Route::get('/download/{filename}', function ($filename) {
    $path = public_path('images/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }
    return response()->download($path);
})->name('download.image');

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

    Route::get('/admin/transaksi', [AdminController::class, 'transaksi'])->name('admin.transaksi');

    Route::get('/editM/{id}', [AdminController::class, 'editCover'])->name('admin.editM');
    Route::put('/editM/update/{id}', [AdminController::class, 'updateM'])->name('admin.updateM');
    Route::delete('/deleteM/{id}', [AdminController::class, 'deleteM'])->name('admin.deleteM');

    Route::get('/video/create/{id}', [AdminController::class, 'createMateri'])->name('video');
    Route::post('/createV/{id}', [AdminController::class, 'storeMateri'])->name('materi.store');
    Route::get('/editV/{id}', [AdminController::class, 'editV'])->name('admin.editV');
    Route::put('/editV/update/{id}', [AdminController::class, 'updateV'])->name('materi.updateV');
    Route::delete('/deleteV/{id}', [AdminController::class, 'deleteV'])->name('materi.deleteV');
    Route::delete('/deleteC/{id}', [AdminController::class, 'deleteCover'])->name('cover.delete');

    Route::get('/cover/create', [AdminController::class, 'createCover'])->name('cover.create');
    Route::post('/cover/store', [AdminController::class, 'storeCover'])->name('cover.store');

    Route::get('/datamateri', [AdminController::class, 'dataCover'])->name('admin.cover');
    Route::get('/manageM/{id}', [AdminController::class, 'dataMateri'])->name('admin.materi');

    Route::get('/dataquiz', [AdminController::class, 'dataQuiz'])->name('admin.quiz');
    Route::get('/createquiz', [AdminController::class, 'createQuiz'])->name('quiz.create');
    Route::post('/quiz/store', [AdminController::class, 'storeQuiz'])->name('quiz.store');
    Route::get('/quiz/edit/{id}', [AdminController::class, 'editQuiz'])->name('quiz.edit');
    Route::post('/quiz/update/{id}', [AdminController::class, 'updateQuiz'])->name('quiz.update');
    Route::delete('/quiz/delete/{id}', [AdminController::class, 'deleteQuiz'])->name('quiz.delete');

    Route::get('/soal/{id}', [AdminController::class, 'dataSoal'])->name('admin.soal');
    Route::get('/soal/create/{id}', [AdminController::class, 'createSoal'])->name('soal.create');
    Route::post('/soal/store/{id}', [AdminController::class, 'storeSoal'])->name('soal.store');
    Route::get('/soal/edit/{id}', [AdminController::class, 'editSoal'])->name('soal.edit');
    Route::put('/soal/update/{id}', [AdminController::class, 'updateSoal'])->name('soal.update');
    Route::delete('/soal/delete/{id}', [AdminController::class, 'deleteSoal'])->name('soal.delete');
});
