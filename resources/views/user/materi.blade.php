@extends('layouts.navbar.navbarprofile')

@section('title', 'Materi')

@section('content')
@if (session('success'))
    <div class="bg-green-500 text-white p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@php
    $isPremium = Auth::user() && Auth::user()->isPremium();
    $firstMateri = $materi->first();
@endphp

<!-- Container utama -->
<div class="flex flex-col md:flex-row gap-4">
    <!-- Video Section -->
    <div class="md:w-2/3 shadow-lg shadow-blue-400 rounded-lg p-4">
        <h1 class=" text-3xl">{{ $cover->judul}}</h1>
        @if ($firstMateri)
            @php
                $embedUrl = str_replace("watch?v=", "embed/", $firstMateri->path);
            @endphp
            <iframe id="video-frame" width="100%" height="400" class="rounded-lg"
                src="{{ $embedUrl }}"
                frameborder="0" allowfullscreen>
            </iframe>
        @else
            <p class="text-gray-700 text-center">Belum ada materi yang tersedia.</p>
        @endif
    </div>

    <!-- Sidebar Materi & Quiz -->
    <div class="md:w-1/3 bg-white shadow-lg shadow-blue-400 rounded-lg p-4 border">
        <h2 class="text-center font-bold text-lg mb-2">Daftar Materi</h2>
        <div class="max-h-[400px] overflow-y-auto">
            <ul>
                @foreach ($materi as $index => $item)
                    <li class="flex items-center p-3 border-b justify-between">
                        <div class="flex items-center">
                            @if ($isPremium || $index == 0)
                                <button onclick="changeVideo('{{ addslashes($item->video_url) }}', `{{ addslashes($item->deskripsi) }}`)">
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
                <div class="max-h-[300px] overflow-y-auto">
                    <ul>
                        @foreach ($quiz as $q)
                            <li class="p-3 border-b">
                                <a href="{{ route('quiz.show', ['id' => $q->id]) }}" class="text-blue-600 font-semibold hover:underline">
                                    {{ $q->judul }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Bagian Quiz -->

    </div>
</div>

<!-- Modal Peringatan -->
<div id="alertModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg">
        <p class="text-gray-800 text-lg">Anda harus menjadi pengguna Premium untuk mengakses materi ini.</p>
        <button onclick="closeModal()" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Tutup</button>
    </div>
</div>

<script>
    function changeVideo(videoUrl, description) {
        document.getElementById("video-frame").src = videoUrl;
        document.getElementById("video-description").innerText = description;
    }

    function showLockedAlert() {
        document.getElementById("alertModal").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("alertModal").classList.add("hidden");
    }
</script>

@endsection
