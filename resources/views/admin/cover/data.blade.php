@extends('layouts.navbar.sidebar')

@section('title', 'Data Cover')

@section('content')
    @if (session('success'))
    <div class=" bg-green-600 text-white p-3 rounded-md mb-4">
        {{ session('success') }}
    </div>
    @elseif (session('warning'))
    <div class=" bg-yellow-500 text-white p-3 rounded-md mb-4">
    {{ session('warning') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h1 class="text-2xl font-bold text-white text-center">DASHBOARD ADMIN</h1>
    <div class="flex flex-row items-center justify-between px-3 py-3  rounded-lg">
        <!-- Kiri -->
        <div class="flex flex-row items-center gap-4">
            <p class="text-lg font-bold text-white">Data Materi</p>
            <a href="{{ route('cover.create') }}" class="bg-secondary50 text-white px-4 py-2 rounded-3xl">Add new</a>

        </div>

        <!-- Kanan (Search) -->
        <div class="relative flex items-center border border-primary50 rounded-full px-5 py-2 bg-gray-100 h-[48px]">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
            <input type="text" placeholder="search in here" class="bg-gray-100 text-lg border-none px-2 w-32 focus:ring-0 text-primary50">
        </div>
    </div>


    <div class="p-4 flex">
        <div class="bg-gray-300 p-6 rounded-lg w-full ">
            <!-- Item List -->
            <div class="space-y-4">
                @foreach($covers as $cover)
                <!-- Loop item ini untuk setiap materi -->
                <div class="flex items-center  p-4 ">
                    <!-- Thumbnail -->
                    <div class="w-16 h-16 bg-gray-400 rounded-md">

                        @if($cover->thumbnail)
                        <img id="thumbnail" src="{{ asset('storage/'.$cover->thumbnail) }}" alt="Thumbnail" class="w-16 h-16 object-cover">

                        @else
                            Tidak ada gambar
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="ml-4 flex-1">
                        <p class="text-lg font-bold">{{ $cover->judul }}</p>
                        <p class="text-gray-600 text-sm">{{ $cover->jurusan?->jurusan ?? 'Jurusan Tidak Diketahui' }}</p>

                    </div>

                    <!-- Video Count -->
                    <div class="text-center">
                        <p class="text-sm text-gray-500">Video</p>
                        <p class="text-lg font-bold">{{ $cover->materi->count() }}</p>
                    </div>

                    <!-- Mentor -->
                    <div class="text-center mx-4">
                        <p class="text-sm text-gray-500">Mentor</p>
                        <p class="text-lg font-bold">{{ $cover->mentor?->nama_mentor ?? 'Mentor tidak diketahui' }}</p>
                    </div>

                    <!-- Actions -->
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.materi', ['id' => $cover->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Manage</a>
                        <form action="{{ route('cover.delete', ['id' => $cover->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                        </form>
                    </div>
                </div>



            @endforeach
                <!-- Tambahkan lebih banyak item di sini -->
            </div>
        </div>
    </div>

    
@endsection
