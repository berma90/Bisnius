@extends(Auth::check() ? 'layouts.navbar.navbarprofile' : 'layouts.navbar.navbaruser')

@section('title', 'Class')

@section('content')
    @include('layouts.navbar.search')

    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Cover</h2>

        @if ($data->isEmpty())
            <p class="text-gray-500 text-lg">Tidak ada data yang ditemukan.</p>
        @else
            @php
                $groupedCovers = $data->groupBy('jurusan.jurusan');
            @endphp

            @foreach ($groupedCovers as $jurusan => $covers)
                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">{{ $jurusan ?? 'Tanpa Jurusan' }}</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($covers as $cover)
                        @if (Auth::check())
                            <a href="{{ route('cover.show', $cover->id) }}" class="block">
                        @else
                            <a href="{{ route('login') }}" onclick="return confirm('Anda harus login terlebih dahulu untuk melihat detail cover. Apakah Anda ingin login sekarang?');" class="block">
                        @endif
                            <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                                <img src="{{ $cover->thumbnail ? asset('storage/' . $cover->thumbnail) : asset('images/default-cover.jpg') }}"
                                    alt="{{ $cover->judul }}" class="w-full h-48 object-cover">

                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $cover->judul }}</h3>
                                    <p class="text-gray-600 text-sm mt-1">From: {{ $cover->mentor->nama_mentor ?? 'Tidak tersedia' }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>
@endsection
