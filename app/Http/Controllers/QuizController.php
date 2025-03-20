<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\PngEncoder;
use App\Models\Quiz;
use App\Models\Soal;
use App\Models\Sertifikat;
use App\Models\Dataquiz;

class QuizController extends Controller
{
    public function nextSoal(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $question = Soal::find($request->question_id);

        if (!$question) {
            return redirect()->route('quiz.finish', ['id' => $quiz->id]);
        }

        // Cek apakah jawaban sudah ada sebelumnya
        $existingAnswer = Dataquiz::where([
            ['fk_user', Auth::id()],
            ['fk_quiz', $quiz->id],
            ['fk_soal', $question->id],
        ])->first();

        if (!$existingAnswer) {
            $isCorrect = $request->jawaban === $question->correct;
            $scoreIncrement = $isCorrect ? 10 : 0;

            Dataquiz::create([
                'fk_user' => Auth::id(),
                'fk_quiz' => $quiz->id,
                'fk_soal' => $question->id,
                'jawaban' => $request->jawaban,
                'is_correct' => $isCorrect ? 1 : 0,
                'score' => $scoreIncrement,
            ]);

            session(['quiz_score' => session('quiz_score', 0) + $scoreIncrement]);
        }

        // Perbarui indeks pertanyaan
        session(['current_question' => session('current_question', 0) + 1]);

        // Cek apakah quiz selesai
        if (session('current_question') >= $quiz->soal()->count()) {
            return redirect()->route('quiz.finish', ['id' => $quiz->id]);
        }

        return redirect()->route('quiz.show', ['id' => $quiz->id]);
    }

    public function quiz($id)
    {
        $quiz = Quiz::with('soal')->findOrFail($id);
        $currentIndex = session('current_question', 0);

        if ($currentIndex >= $quiz->soal->count()) {
            return redirect()->route('quiz.finish', ['id' => $id]);
        }

        return view('user.quiz', [
            'quiz' => $quiz,
            'question' => $quiz->soal[$currentIndex]
        ]);
    }

    public function quizResult($quizId)
    {
        $quiz = Quiz::with('soal')->findOrFail($quizId);
        $totalScore = session('quiz_score', Dataquiz::where('fk_user', Auth::id())
            ->where('fk_quiz', $quizId)
            ->sum('score'));

        $correctAnswers = Dataquiz::where('fk_user', Auth::id())
            ->where('fk_quiz', $quizId)
            ->where('is_correct', 1)
            ->count();

        if ($correctAnswers >= ($quiz->soal->count() - 1)) {
            DB::table('sertifikat')->updateOrInsert(
                ['user_id' => Auth::id(), 'quiz_id' => $quizId],
                ['score' => $totalScore, 'created_at' => now()]
            );
        }

        session()->forget(['quiz_id', 'current_question', 'quiz_score']);

        return view('user.result', compact('quiz', 'totalScore', 'correctAnswers'));
    }

    public function resetQuiz($id)
    {
        session()->forget(['quiz_score', 'current_question', 'user_answers']);
        return redirect()->route('quiz.show', ['id' => $id]);
    }

    public function finishQuiz($id)
    {
        $quiz = Quiz::with('soal')->findOrFail($id);

        // Ambil total skor
        $totalScore = session('quiz_score', Dataquiz::where('fk_user', Auth::id())
            ->where('fk_quiz', $quiz->id)
            ->sum('score'));

        // Hitung jawaban benar
        $correctAnswers = Dataquiz::where('fk_user', Auth::id())
            ->where('fk_quiz', $quiz->id)
            ->where('is_correct', 1)
            ->count();

        // Tentukan hasil
        $message = $correctAnswers >= ($quiz->soal->count() - 1)
            ? "Selamat, kamu lulus dengan skor $totalScore."
            : "Belum lulus. Coba lagi!";

        // Hapus sesi setelah selesai
        session()->forget(['quiz_score', 'current_question', 'user_answers']);

        return view('user.result', compact('quiz', 'totalScore', 'message'));
    }

    public function ulangiQuiz($quizId)
    {
        $userId = Auth::id();

        // Hapus data quiz berdasarkan user dan quiz
        Dataquiz::where('fk_user', $userId)->where('fk_quiz', $quizId)->delete();

        return redirect()->route('quiz.show', ['id' => $quizId])->with('success', 'Quiz telah diulang.');
    }

    public function generateCertificate($quizId)
    {
        $user = Auth::user();
        $quiz = Quiz::findOrFail($quizId);

        // Cek apakah sertifikat sudah ada untuk user dan quiz tersebut
        $existingCertificate = Sertifikat::where('fk_user', $user->id)
                                        ->where('fk_quiz', $quiz->id)
                                        ->first();

        if ($existingCertificate) {
            // Jika sertifikat sudah ada, arahkan ke halaman result dengan pesan
            return redirect()->route('quiz.finish', ['id' => $quizId])
                            ->with('info', 'Sertifikat sudah ada di Profile -> Appreciate.');
        }

        $boldFontPath = public_path('fonts/Roboto-Bold.ttf');
        $regularFontPath = public_path('fonts/Roboto-Regular.ttf');
        $imagePath = public_path('images/certificate.png');

        if (!file_exists($boldFontPath) || !file_exists($regularFontPath)) {
            return response()->json(['error' => 'Font tidak ditemukan'], 404);
        }

        if (!file_exists($imagePath)) {
            return response()->json(['error' => 'Template sertifikat tidak ditemukan'], 404);
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read($imagePath);

        // Konversi gambar ke format PNG
        $imageEncoded = $image->toPng()->toString(); // Menggunakan toString() untuk mendapatkan data biner

        // Simpan ke database
        $sertifikat = new Sertifikat();
        $sertifikat->fk_user = $user->id;
        $sertifikat->fk_quiz = $quiz->id;
        $sertifikat->fk_dataquiz = $quiz->dataquiz_id ?? 0;

        // Simpan gambar ke penyimpanan lokal
        $fileName = 'certificate_' . $user->id . '_' . $quiz->id . '.png';
        $filePath = 'public/certificates/' . $fileName;
        Storage::put($filePath, $image->toPng());

        // Simpan hanya jalur file, bukan isi gambarnya!
        $sertifikat->path = $filePath;
        $sertifikat->save();

        return redirect()->route('quiz.finish', ['id' => $quizId])
                        ->with('success', 'Sertifikat berhasil dibuat! Cek Profile -> Appreciate untuk melihat sertifikat.');
    }

}
