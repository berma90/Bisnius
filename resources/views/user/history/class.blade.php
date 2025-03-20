@extends('user.profile')

@section('history_content')
<div class="p-5 mt-6">
    <h2 class="text-xl font-semibold mb-4">Class History</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach ($history as $h)
            <div class="border border-black rounded-lg shadow-lg p-4 flex mx-auto w-[450px] space-x-6">
                <!-- Thumbnail -->
                <div class="w-[160px] h-[200px] bg-gray-200 rounded-lg flex items-center justify-center">
                    <img src="{{ asset('storage/' . $h->cover->thumbnail) }}" alt="Thumbnail" class="w-full h-full object-cover rounded-lg">
                </div>
                <!-- Konten -->
                <div class="flex flex-col justify-between min-h-[200px] w-full">
                    <div>
                        <h3 class="text-lg font-semibold mb-2">{{ $h->cover->judul }}</h3>
                        <p class="text-sm mb-4">Hai,Selamat datang di Kelas saya. Disini saya akan membimbing anda untuk belajar tentang bisnis</p>
                        <p class="text-gray-500 text-sm mb-4">Tanggal Lihat: {{ $h->created_at->format('d M Y H:i A') }}</p>
                    </div>
                    <!-- Bagian bawah -->
                    <div class="flex justify-between items-center mt-auto border-t pt-2">
                        <p class="text-gray-500 text-sm">From: {{ $h->cover->mentor->nama_mentor }}</p>
                        <a href="{{ route('cover.show', $h->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">
                            Lihat Kelas
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
