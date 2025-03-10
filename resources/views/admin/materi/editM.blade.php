@extends('layouts.navbar.sidebar')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold text-white text-center">DASHBOARD ADMIN</h1>
<div class="flex flex-row items-center justify-between px-3 py-3  rounded-lg">
    <!-- Kiri -->
    <div class="flex flex-row items-center gap-4">
        <p class="text-lg font-bold text-white">Edit Materi</p>
        
    </div> 
</div>


<div class="flex p-4">
    <div class="bg-gray-300 rounded-xl w-full max-w-2xl p-6">
        <!-- Form -->
        <div class="space-y-4">
            <!-- Input Nama -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" class="w-full border border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Input Kategori -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                <input type="text" class="w-full border border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Input Thumbnail -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Thumbnail</label>
                <input type="file" accept="image/*" class="w-full  rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            

            <!-- Dropdown Nama Mentor -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Mentor</label>
                <select class="w-full border border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Pilih Mentor</option>
                    <option>Adhi S</option>
                    <option>Budi R</option>
                </select>
            </div>

            <!-- Input Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea class="w-full border border-gray-400 rounded-md p-2 h-24 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="flex justify-end mt-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm">Simpan</button>
        </div>
    </div>
</div>

@endsection