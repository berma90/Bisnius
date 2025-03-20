@extends('layouts.navbar.sidebar')

@section('title', 'Tambah Materi')

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
            <p class="text-lg font-bold text-white">Tambah Video Materi</p>

        </div>
    </div>


    <div class="max-h-screen flex p-4">
        <div class="bg-netral50 rounded-xl w-full h-[400px] p-6 relative">
            <form method="POST" action="{{route ('materi.store',$id) }}" enctype="multipart/form-data">
                @csrf
                <!-- Form -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="judul" id="judul" class="w-full border border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Path Video</label>
                        <input type="text" name="path" id="path" class="w-full border border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" class="w-full border border-gray-400 rounded-md p-2 h-24 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class=" absolute bottom-4 right-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm">Simpan</button>
                </div>
                @if(session('success'))
                <div class="bg-green-500 w-[500px] text-white p-4 rounded-md mt-2">
                    {{ session('success') }}
                </div>
                @endif
            </form>
        </div>
    </div>
@endsection
