@extends('layouts.navbar.navbarprofile')

@section('title', 'Materi')

@section('content')
@if (session('success'))
    <div class="bg-green-500 text-white p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@php
    use Illuminate\Support\Str;

    $isPremium = Auth::user() && Auth::user()->isPremium();
    $firstMateri = $materi->first();

    function convertToEmbedUrl($url) {
        $videoId = '';

        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&?\/]+)/', $url, $matches)) {
            $videoId = $matches[1] ?? '';
        }

        return !empty($videoId) ? "https://www.youtube.com/embed/$videoId" : null;
    }

    $firstVideoUrl = $firstMateri ? convertToEmbedUrl($firstMateri->path) : null;
@endphp

<div class="flex flex-col md:flex-row gap-4">
    <div class="md:w-2/3 shadow-lg shadow-blue-400 border rounded-lg p-4" style="height: calc(100vh - 115px);">
        <h1 class="text-3xl font-bold">{{ $firstMateri->judul ?? 'Judul tidak tersedia' }}</h1>
        @if($firstVideoUrl)
        <div class="relative min-h-[400px]">
            <iframe id="video-frame" class="absolute top-0 left-0 w-full h-full" src="{{ $firstVideoUrl }}?autoplay=1&mute=1&origin={{ request()->getSchemeAndHttpHost() }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
            </iframe>
        </div>
        @else
            <p class="text-red-500">Video tidak tersedia atau URL tidak valid.</p>
        @endif
        <div id="video-description" class="min-h-[100px] border-t border-gray-300 mt-4 p-2">
            <p>{{ $firstMateri->deskripsi ?? 'Deskripsi tidak tersedia' }}</p>
        </div>
    </div>

    <div class="md:w-1/3 h-[480px] bg-white shadow-lg shadow-blue-400 rounded-lg p-4 border">
        <h2 class="text-center font-bold text-lg mb-2">Daftar Materi</h2>
        <div class="max-h-[400px] overflow-y-auto">
            <ul>
                @foreach ($materi as $index => $item)
                    @php $embedUrl = convertToEmbedUrl($item->path); @endphp
                    <li class="flex items-center p-3 border-b justify-between">
                        <div class="flex items-center">
                            @if ($isPremium || $index == 0)
                                <button onclick="changeVideo('{{ addslashes($embedUrl) }}', '{{ addslashes($item->deskripsi) }}')">
                                    <img src="{{ asset('img/button.png') }}" alt="Button" class="w-12 h-8">
                                </button>
                            @else
                                <button onclick="showLockedAlert()">
                                    <img src="{{ asset('img/buttonlock.png') }}" alt="Button" class="w-12 h-8">
                                </button>
                            @endif
                            <span class="ml-4 text-lg font-semibold text-gray-800">{{ $item->judul }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
            @if ($quiz->count() > 0)
                <h2 class="text-center font-bold text-lg mt-4 mb-2">Quiz</h2>
                <ul class="max-h-[300px] overflow-y-auto">
                    @foreach ($quiz as $q)
                        @php
                            $hasCompletedQuiz = \App\Models\Dataquiz::where('fk_user', Auth::id())
                                ->where('fk_quiz', $q->id)
                                ->exists();
                        @endphp

                        <li class="p-3 border-b">
                            @if ($isPremium)
                                @if (!$hasCompletedQuiz)
                                    <a href="{{ route('quiz.show', ['id' => $q->id]) }}" class="text-blue-600 font-semibold hover:underline">
                                        {{ $q->judul }}
                                    </a>
                                @else
                                    <button onclick="showQuizModal('{{ route('quiz.ulangi', ['id' => $q->id]) }}', '{{ route('quiz.finish', ['id' => $q->id]) }}')" class="text-gray-500 font-semibold">
                                        {{ $q->judul }} (Sudah dikerjakan)
                                    </button>
                                @endif
                            @else
                                <button onclick="showLockedAlert()" class="text-gray-500 font-semibold">
                                    {{ $q->judul }} (Terkunci)
                                </button>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
            </ul>
        </div>
    </div>
</div>

<div id="quizModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h2 class="text-xl font-semibold text-gray-800">Mulai Kuis</h2>
        <p class="text-gray-600 mt-2">Apakah Anda yakin ingin memulai kuis?</p>
        <div class="flex justify-end mt-4">
            <button onclick="closeQuizModal()" class="px-4 py-2 bg-gray-400 text-white rounded-lg mr-2">Batal</button>
            @foreach ($quiz as $q)
                <a href="{{ route('quiz.ulangi', ['id' => $q->id]) }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Mulai</a>
                <a href="{{ route('quiz.finish', ['id' => $q->id]) }}" class="px-4 py-2 bg-green-500 text-white rounded-lg ml-2">Lihat Hasil</a>
            @endforeach
        </div>
    </div>
</div>

<div id="alertModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h2 class="text-xl font-semibold text-gray-800">Fitur Terkunci</h2>
        <p class="text-gray-600 mt-2">Silakan upgrade ke akun premium untuk mengakses materi ini.</p>
        <div class="flex justify-end mt-4">
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-400 text-white rounded-lg mr-2">Tutup</button>
            <a href="/buypremium" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Upgrade Sekarang</a>
        </div>
    </div>
</div>

<script>
    function changeVideo(videoUrl, description) {
        if (!videoUrl.includes("youtube.com/embed/")) {
            alert("Video tidak tersedia atau tidak dapat diputar.");
            return;
        }
        let newSrc = videoUrl + "?autoplay=1&mute=1&origin=" + window.location.origin;
        document.getElementById("video-frame").src = newSrc;
        document.getElementById("video-description").innerText = description;
    }

    function showQuizModal(startUrl, resultUrl) {
        document.getElementById("quizModal").classList.remove("hidden");
        document.getElementById("startQuizBtn").href = startUrl;
        document.getElementById("viewResultBtn").href = resultUrl;
        document.getElementById("viewResultBtn").classList.remove("hidden");
    }

    function showLockedAlert() {
        document.getElementById("alertModal").classList.remove("hidden");
    }

    function closeQuizModal() {
        document.getElementById("quizModal").classList.add("hidden");
    }
</script>
@endsection
