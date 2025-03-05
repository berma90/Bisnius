@extends('layouts.navbar.sidebaradm')

@section('title', 'Tambah-Mentor')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold underline">Data Mentor</h1>

    <div class="bg-gray-300 p-6 rounded-xl mt-4">
        <form action="{{ route('mentor.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <!-- Foto Upload -->
                <div>
                    <label class="block text-sm font-medium">Foto</label>
                    <div class="flex items-center mt-1">
                        <div class="w-20 h-20 bg-white border rounded-lg flex items-center justify-center">
                            <span class="text-gray-500">📷</span>
                        </div>
                        <label class="ml-2 px-3 py-1 bg-blue-600 text-white text-sm rounded cursor-pointer">
                            Pilih Foto
                            <input type="file" name="foto" class="hidden">
                        </label>
                    </div>
                </div>

                <!-- Nama dan URL Telegram -->
                <div>
                    <label class="block text-sm font-medium">Nama</label>
                    <input type="text" name="nama" class="w-full p-2 border rounded-md" required>

                    <label class="block text-sm font-medium mt-2">URL Tele</label>
                    <input type="text" name="url_tele" class="w-full p-2 border rounded-md" required>
                </div>
            </div>

            <!-- Kategori -->
            <div class="mt-4">
                <label class="block text-sm font-medium">Kategori</label>
                <select name="kategori" class="w-full p-2 border rounded-md">
                    <option value="">Pilih Kategori</option>
                    @foreach ($jurusan as $jrs)
                        <option value="{{ $jrs->id }}">{{ $jrs->nama_jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Deskripsi -->
            <div class="mt-4">
                <label class="block text-sm font-medium">Deskripsi</label>
                <textarea name="deskripsi" class="w-full p-2 border rounded-md h-24" required></textarea>
            </div>

            <!-- Tombol Simpan -->
            <div class="mt-4 flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection