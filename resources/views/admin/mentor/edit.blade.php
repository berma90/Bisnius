@extends('layouts.navbar.sidebar')

@section('title', 'Edit Mentor')

@section('content')
    <h1 class="text-3xl font-bold text-secondary10 text-center">DASHBOARD ADMIN</h1>
    <p class="mt-2 text-xl font-bold text-white">Edit Mentor</p>

    <div class="bg-netral50 p-6 rounded-xl mt-4">
        <form action="{{ route('mentor.update', $mentor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Foto Upload -->
            <div>
                <label class="block text-sm font-medium">Foto</label>
                <div class="flex items-center mt-2">
                    <div class="w-[100px] h-[100px] bg-white border rounded-lg flex items-center justify-center overflow-hidden">
                        @if ($mentor->foto)
                            <img id="previewImage" src="{{ asset('storage/' . $mentor->foto) }}" class="w-full h-full object-cover">
                        @else
                            <img id="previewImage" class="w-full h-full object-cover hidden">
                        @endif
                    </div>
                    <!-- Input File -->
                    <label class="flex ml-2 px-3 py-1 bg-primary50 text-white text-sm font-semibold rounded cursor-pointer mt-[70px]">
                        Pilih Foto
                        <input type="file" name="foto" class="hidden" id="imageInput" accept="image/*">
                    </label>
                </div>
            </div>

            <!-- Nama dan URL Telegram -->
            <div class="mt-4 grid grid-cols-2">
                <div class="w-[550px]">
                    <label class="block text-sm font-medium">Nama</label>
                    <input type="text" name="nama_mentor" class="w-full p-2 border rounded-md bg-transparent" value="{{ $mentor->nama_mentor }}" required>
                </div>

                <div>
                    <label class="block text-sm font-medium">URL Tele</label>
                    <input type="text" name="chat" class="w-full p-2 border rounded-md bg-transparent" value="{{ $mentor->chat }}" required>
                </div>
            </div>

            <!-- Kategori -->
            <div class="mt-4">
                <label class="block text-sm font-medium">Kategori</label>
                <select name="id_jurusan" class="w-full p-2 border rounded-md bg-transparent">
                    <option value="">Pilih Kategori</option>
                    @foreach ($jurusan as $jrs)
                        <option value="{{ $jrs->id }}" {{ $mentor->id_jurusan == $jrs->id ? 'selected' : '' }}>{{ $jrs->jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Deskripsi -->
            <div class="mt-4">
                <label class="block text-sm font-medium">Deskripsi</label>
                <textarea name="deskripsi" class="w-full p-2 border rounded-md h-24 bg-transparent" required>{{ $mentor->deskripsi }}</textarea>
            </div>

            <!-- Tombol Simpan -->
            <div class="mt-4 flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('previewImage');
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
