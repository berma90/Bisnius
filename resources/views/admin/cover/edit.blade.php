@extends('layouts.navbar.sidebar')

@section('title', 'Edit Materi')

@section('content')
<h1 class="text-2xl font-bold text-white text-center">EDIT MATERI</h1>

<div class="flex p-4">
    <div class="bg-netral50 rounded-xl w-full p-6">
        <!-- Form Edit -->
        <form action="{{ route('admin.updateM', $covers->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <!-- Input Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="judul" value="{{ $covers->judul }}" 
                        class="w-full border border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Input Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select id="fk_jurusan" name="fk_jurusan" 
                        class="w-full border border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        
                        <option value="">Pilih Kategori</option>
                
                        @foreach($jurusan as $jurus)
                            <option value="{{ $jurus->id }}" 
                                {{ $covers->fk_jurusan == $jurus->id ? 'selected' : '' }}>
                                {{ $jurus->jurusan }}
                            </option>
                        @endforeach
                
                    </select>
                </div>
                

                <!-- Input Thumbnail -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Thumbnail</label>
                    <input type="file" name="thumbnail" accept="image/*" 
                        class="w-full rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    
                    <!-- Tampilkan Thumbnail Saat Ini -->
                    @if($covers->thumbnail)
                        <img src="{{ asset('storage/' . $covers->thumbnail) }}" alt="Thumbnail" class="mt-2 w-24 h-24 object-cover rounded-md">
                    @endif
                </div>

                <!-- Dropdown Nama Mentor -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Mentor</label>
                    <select name="mentor" class="w-full border border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Mentor</option>
                        <option value="Adhi S" {{ $covers->mentor == 'Adhi S' ? 'selected' : '' }}>Adhi S</option>
                        <option value="Budi R" {{ $covers->mentor == 'Budi R' ? 'selected' : '' }}>Budi R</option>
                    </select>
                </div>

                <!-- Input Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" class="w-full border border-gray-400 rounded-md p-2 h-24 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $covers->deskripsi }}</textarea>
                </div>
            </div>

            <!-- Tombol Simpan -->
            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
