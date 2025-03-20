@extends('layouts.navbar.sidebar')

@section('title', 'Edit Materi')

@section('content')
    @if (session('error'))
        <div class=" bg-red-500 text-white p-3 rounded-md mb-4">
            {{ session('error') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold text-white text-center">DASHBOARD ADMIN</h1>
    <div class="flex flex-row items-center justify-between px-3 py-3  rounded-lg">
        <!-- Kiri -->
        <div class="flex flex-row items-center gap-4">
            <p class="text-lg font-bold text-white">Edit Video Materi</p>

        </div>
    </div>


    <div class=" min-h-screen flex  p-4">
        <div class="bg-netral50 rounded-xl w-full h-[300px] p-6">

            <form action="{{ route('materi.updateV', ['id' => $materis->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <!-- Form -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="judul" value="{{ $materis->judul }}" class="w-full border border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Path Video</label>
                        <input type="text" name="path" value="{{ $materis->path }}" class="w-full border border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" class="w-full border border-gray-400 rounded-md p-2 h-24 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $materis->deskripsi }}</textarea>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end mt-14">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
