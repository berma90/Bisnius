@extends('layouts.navbar.sidebar')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold text-white text-center">DASHBOARD ADMIN</h1>
<div class="flex flex-row items-center justify-between px-3 py-3  rounded-lg">
    <!-- Kiri -->
    <div class="flex flex-row items-center gap-4">
        <p class="text-lg font-bold text-white">Tambah Video Materi</p>
        
    </div> 
</div>


<div class=" min-h-screen flex  p-4">
    <div class="bg-gray-300 rounded-xl w-[600px] h-[340px] max-w-2xl p-6">

        <form method="POST" action="/createV">
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
                
            </div>
            
            <!-- Tombol Simpan -->
            <div class="flex justify-end mt-10">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm">Simpan</button>
            </div>
        </form>
        @if(session('success'))
        <div class="bg-green-500 w-[500px] text-white p-4 rounded-md mt-2">
            {{ session('success') }}
        </div>
        @endif
        
    </div>
</div>
@endsection