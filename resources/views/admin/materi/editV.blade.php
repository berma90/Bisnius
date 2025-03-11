@extends('layouts.navbar.sidebar')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold text-white text-center">DASHBOARD ADMIN</h1>
<div class="flex flex-row items-center justify-between px-3 py-3  rounded-lg">
    <!-- Kiri -->
    <div class="flex flex-row items-center gap-4">
        <p class="text-lg font-bold text-white">Edit Video Materi</p>
        
    </div> 
</div>


<div class=" min-h-screen flex  p-4">
    <div class="bg-gray-300 rounded-xl w-[600px] h-[280px] max-w-2xl p-6">

        <!-- Form -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" class="w-full border border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Path Video</label>
                <input type="text" class="w-full border border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="flex justify-end mt-14">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm">Simpan</button>
        </div>
    </div>
</div>
@endsection