@extends('layouts.navbar.navbaruser')

@section('title', 'Home')

@if (session('success'))
    <div class="bg-green-500 text-white p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Materi pengenalan</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Video Section -->
        <div class="md:col-span-2 shadow-lg shadow-blue-400 rounded-lg p-4">
            <div class="relative">
                <iframe id="video-frame" width="100%" height="400" class="rounded-lg"
                    src="https://www.youtube.com/embed/8g1H3ipDNOs" 
                    frameborder="0" allowfullscreen>
                </iframe>
            </div>
            <div class="mt-4 p-4 border rounded-lg relative">
                <h2 class="font-bold text-lg text-center">Deskripsi</h2>
                <p id="video-description" class="text-gray-700 mt-2">
                    Bisnis adalah kegiatan yang dilakukan individu atau organisasi untuk menghasilkan keuntungan dengan menyediakan barang atau jasa yang dibutuhkan oleh masyarakat.
                </p>

                <!-- Forum Diskusi -->
                <a href="#" class="absolute bottom-2 right-2 flex items-center hover:underline">
                    <img src="img/diskusi.png" alt="Chat Icon" class="w-6 h-6 mr-2">
                    <span>Forum diskusi</span>
                </a>
            </div>
        </div>

        <!-- Sidebar Materi -->
        <div class="bg-white shadow-lg shadow-blue-400 rounded-lg p-4 border">
            <ul>
                @php
                    $isPremium = Auth::user() && Auth::user()->isPremium(); // Cek status premium user
                @endphp

                @for ($i = 1; $i <= 6; $i++)
                <li class="flex items-center p-3 border-b justify-between">
                    <div class="flex items-center">
                        @if ($isPremium || $i == 1) 
                            <!-- Jika user premium atau materi pertama, bisa diakses -->
                            <button onclick="changeVideo({{ $i }})">
                                <img src="img/button.png" alt="Button" class="w-12 h-8">
                            </button>
                        @else
                            <!-- Jika bukan premium, materi dikunci -->
                            <button onclick="showLockedAlert()">
                                <img src="img/buttonlock.png" alt="Button" class="w-12 h-8">
                            </button>
                        @endif
                        <span class="ml-4 text-lg font-semibold text-gray-800">Materi {{ $i }}</span>
                    </div>
                </li>
                @endfor
            </ul>
        </div>
    </div>
</div>

<!-- Modal Alert (Hidden by Default) -->
<div id="alertModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h2 class="text-xl font-semibold text-gray-800">Materi Terkunci</h2>
        <p class="text-gray-600 mt-2">Silakan upgrade ke akun premium untuk mengakses materi ini.</p>
        <div class="flex justify-end mt-4">
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-400 text-white rounded-lg mr-2">Tutup</button>
            <a href="/buypremium" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Upgrade Sekarang</a>
        </div>
    </div>
</div>

<script>
    function changeVideo(materi) {
        let videoData = {
            1: {url: "https://www.youtube.com/embed/8g1H3ipDNOs", description: "Bisnis adalah kegiatan ..."},
            2: {url: "https://www.youtube.com/embed/89QEZGxWYZc", description: "Marketing adalah strategi ..."},
            3: {url: "https://www.youtube.com/embed/VIDEO_ID_3", description: "Keuangan dalam bisnis ..."},
            4: {url: "https://www.youtube.com/embed/VIDEO_ID_4", description: "Memulai startup ..."},
            5: {url: "https://www.youtube.com/embed/VIDEO_ID_5", description: "Manajemen yang efektif ..."},
            6: {url: "https://www.youtube.com/embed/VIDEO_ID_6", description: "Strategi bisnis yang sukses ..."}
        };

        if (videoData[materi]) {
            document.getElementById("video-frame").src = videoData[materi].url;
            document.getElementById("video-description").innerText = videoData[materi].description;
        }
    }

    function showLockedAlert() {
        document.getElementById("alertModal").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("alertModal").classList.add("hidden");
    }


</script>

@endsection
