    @extends('layouts.navbar.navbarprofile')

    @section('title', 'Quiz')

    @section('content')
        @if (!$quiz || $quiz->soal->isEmpty())
            <p>Quiz tidak ditemukan atau belum memiliki pertanyaan.</p>
        @else
            @php
                $totalQuestions = $quiz->soal->count();
                $currentIndex = session('current_question', 0);
                $score = session('quiz_score', 0);
                $currentQuestion = $quiz->soal[$currentIndex] ?? null;
            @endphp
        @endif

        <div class="mx-auto max-w-2xl p-6">
            @if ($currentIndex < $totalQuestions && $currentQuestion)
                <div class="bg-white shadow-lg p-6 rounded-lg">
                    <h2 class="text-lg font-bold mb-4">{{ $currentIndex + 1 }}. {{ $currentQuestion->pertanyaan }}</h2>

                    <form id="quiz-form" action="{{ route('quiz.next', ['id' => $quiz->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="question_id" value="{{ $currentQuestion->id }}">
                        <input type="hidden" name="next_index" value="{{ $currentIndex + 1 }}">

                        <div class="space-y-3">
                            @foreach (['a' => 'pilihan1', 'b' => 'pilihan2', 'c' => 'pilihan3', 'd' => 'pilihan4'] as $key => $option)
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="jawaban" value="{{ $key }}" class="form-radio h-5 w-5 text-blue-600" required>
                                    <span>{{ strtoupper($key) }}. {{ $currentQuestion->$option }}</span>
                                </label>
                            @endforeach
                        </div>

                        <div class="flex justify-between mt-6">
                            <button type="submit" id="next-btn" class="bg-blue-500 text-white px-4 py-2 rounded">
                                {{ $currentIndex + 1 == $totalQuestions ? 'Finish' : 'Selanjutnya' }}
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="text-center p-6 bg-white shadow-lg rounded-lg">
                    <h2 class="text-2xl font-bold mb-4">Quiz Selesai!</h2>
                    <p>Skor Kamu: <span id="score">{{ $score }}</span> / {{ $totalQuestions * 10 }}</p>

                    @if ($score < 100)
                        <a href="{{ route('quiz.reset', ['quizId' => $quiz->id]) }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg mt-4 inline-block">
                            Coba Lagi
                        </a>
                    @endif
                </div>
            @endif
        </div>
        <script>
            localStorage.setItem('value', 'berlin');
        </script>
    @endsection
