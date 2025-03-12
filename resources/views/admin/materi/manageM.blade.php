@extends('layouts.navbar.sidebar')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold text-white text-center">DASHBOARD ADMIN</h1>
    <div class="flex flex-row items-center justify-between px-3 py-3 rounded-lg">
        <!-- Kiri -->
        @if($coverz)
        <div class="flex flex-row items-center gap-4">
            <p class="text-lg font-bold text-white">Data Materi</p>
            <form action="{{ route('video', ['id' => $coverz->id]) }}" method="GET">
                @csrf
                <button type="submit" class="bg-secondary50 text-white px-4 py-2 rounded-3xl">
                    Add new
                </button>
            </form>
        </div> 
        @endif
    </div>

    <div class="min-h-screen flex p-2">
        <div class="bg-gray-300 rounded-xl w-full  p-4">
            
            @if($coverz->count() > 0) 
            @if($coverz) 
                    <div class="flex items-center p-4 border-b border-gray-400">
                        <!-- Thumbnail -->
                        <div class="w-16 h-16 bg-gray-400 rounded-md">
                            @if(!empty($coverz->thumbnail))
                                <img src="{{ asset('storage/'.$coverz->thumbnail) }}" alt="Thumbnail" class="w-16 h-16 object-cover rounded-md">
                            @else
                                <p class="text-xs text-gray-500">Tidak ada gambar</p>
                            @endif
                        </div>
                        
                        <!-- Info -->
                        <div class="ml-4 flex-1">
                            <p class="text-lg font-bold text-black">{{ $coverz->judul ?? 'Tanpa Judul' }}</p>
                            <p class="text-gray-600 text-sm">{{ $coverz->jurusan?->jurusan ?? 'Jurusan Tidak Diketahui' }}</p>
                        </div>

                        <!-- Video Count -->
                        <div class="text-center">
                            <p class="text-sm text-gray-500">Video</p>
                            <p class="text-lg font-bold">{{ $jumlahMateri }}</p>
                        </div>

                        <!-- Mentor -->
                        <div class="text-center mx-4">
                            <p class="text-sm text-gray-500">Mentor</p>
                            <p class="text-lg font-bold">{{ $coverz->mentor ?? 'Tidak Ada Mentor' }}</p>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex gap-2">
                            <a href="{{ route('admin.editM', ['id' => $coverz->id]) }}">
                                <button class="bg-yellow-400 text-black px-3 py-1 rounded-md text-xs">Edit</button>
                            </a>
                            <form action="{{ route('admin.deleteM', ['id' => $coverz->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md text-xs">Delete</button>
                            </form>
                        </div>
                    </div>
                @endif
            @else
                <p class="text-gray-500 text-center">Tidak ada data materi</p>
            @endif

            <hr class="border-gray-300 w-[620px] mx-auto">


            
            <!-- Card 2 -->
            <div class="p-3">
                @foreach ($materiV as $materi)
                <div class="flex items-center bg-gray-300 rounded-lg p-3 mb-2">
                    <!-- Gambar -->
                        <div class="w-16 h-16 bg-gray-300 rounded-md flex-shrink-0">
                            @if(!empty($coverz->thumbnail))
                                <img src="{{ asset('storage/'.$coverz->thumbnail) }}" alt="Thumbnail" class="w-16 h-16 object-cover rounded-md">
                            @else
                                <p class="text-xs text-gray-500">Tidak ada gambar</p>
                            @endif
                        </div>
            
                        <!-- Konten -->
                        <div class="flex-1 ml-4">
                            <p class="font-semibold text-sm">{{ $materi->judul }}</p>
                            <p class="text-xs text-gray-600">{{ $materi->path }}</p>
                        </div>
            
                        <!-- Tombol Aksi -->
                        <div class="flex gap-2">
                            <a href="{{ route('admin.editV', ['id' => $materi->id]) }}">
                                <button class="bg-yellow-400 text-black px-3 py-1 rounded-md text-xs">Edit</button>
                            </a>
                            <form action="{{ route('materi.deleteV', ['id' => $materi->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded-md text-xs">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
    </div>
@endsection
