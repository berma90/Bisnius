@extends('layouts.navbar.navbarprofile')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif

    <div class="container mx-auto max-w-lg mt-10">
        <div class="bg-white shadow-lg rounded-lg p-6 text-center">
            <h2 class="text-2xl font-bold text-gray-800">📊 Hasil Quiz</h2>

            {{-- Pastikan variabel $totalScore tersedia --}}
            @if (isset($totalScore))
                <p class="text-lg mt-4 font-semibold text-gray-700">
                    Skor Anda: <span class="text-blue-500">{{ $totalScore }}</span>
                </p>
                @if ($totalScore >= 100)
                    <p class="text-green-500 font-medium mt-2">🎉 Selamat! Anda telah menyelesaikan quiz dengan skor sempurna!</p>

                    {{-- Tombol Download Sertifikat --}}
                    <div class="mt-4">
                        <a href="{{ route('quiz.certificate', ['quizId' => $quiz->id]) }}"
                            class="px-4 py-2 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600 transition">
                            🎖️ Unduh Sertifikat
                        </a>
                    </div>
                @else
                    <p>Ayo semangat!! Masa ga mau dapat skor 100 untuk claim sertifikat😗</p>
                @endif

                {{-- Tampilkan tombol hanya jika $quiz ada --}}
                @if (isset($quiz))
                    <div class="mt-6 flex justify-center gap-4">
                        <a href="{{ route('quiz.ulangi', ['id' => $quiz->id]) }}"
                            onclick="localStorage.clear();"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition">
                            🔁 Coba Lagi
                        </a>

                        <a href="{{ route('cover.show', $quiz->id) }}"
                            class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition">
                            🏠 Kembali ke Quiz
                        </a>
                    </div>
                @endif
            @else
                <p class="text-red-500 font-medium mt-4">⚠️ Data quiz tidak ditemukan.</p>
            @endif
        </div>
    </div>
@endsection
