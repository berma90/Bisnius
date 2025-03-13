@extends('layouts.navbar.navbarprofile')

@section('title', 'Quiz')

@section('content')
@php
    $totalQuestions = $quiz->soal->count();
    $currentIndex = session('current_question', 0);
    $currentQuestion = $quiz->soal[$currentIndex] ?? null;
@endphp

<div class="container mx-auto p-6">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
        @if ($currentQuestion)
            <h2 class="text-xl font-bold mb-4">{{ $currentIndex + 1 }}. {{ $currentQuestion->pertanyaan }}</h2>
            <form id="quiz-form" action="{{ route('quiz.submit', $quiz->id) }}" method="POST">
                @csrf
                <input type="hidden" name="question_id" value="{{ $currentQuestion->id }}">
                <div class="space-y-2">
                    @foreach (['a', 'b', 'c', 'd', 'e'] as $option)
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="jawaban" value="{{ $option }}" class="form-radio">
                            <span>{{ strtoupper($option) }}. {{ $currentQuestion['opsi_' . $option] }}</span>
                        </label>
                    @endforeach
                </div>
                <div class="flex justify-between mt-6">
                    @if ($currentIndex > 0)
                        <a href="{{ route('quiz.prev', $quiz->id) }}" class="bg-gray-400 text-white px-4 py-2 rounded">&larr; Sebelumnya</a>
                    @endif
                    <button type="submit" id="next-btn" class="bg-blue-500 text-white px-4 py-2 rounded">
                        {{ $currentIndex + 1 == $totalQuestions ? 'Finish' : 'Selanjutnya' }} &rarr;
                    </button>
                </div>
            </form>
        @else
            <p class="text-center text-gray-700">Quiz telah selesai.</p>
            <div class="text-center mt-6">
                <a href="{{ route('quiz.result', $quiz->id) }}" class="bg-green-500 text-white px-6 py-2 rounded">Lihat Skor</a>
            </div>
        @endif
    </div>
</div>

<script>
    document.getElementById("quiz-form").addEventListener("submit", function(event) {
        const selected = document.querySelector("input[name='jawaban']:checked");
        if (!selected) {
            event.preventDefault();
            alert("Harap pilih jawaban sebelum melanjutkan!");
        }
    });
</script>
@endsection
