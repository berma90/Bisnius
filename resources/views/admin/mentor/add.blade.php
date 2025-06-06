@extends('layouts.navbar.sidebar')

@section('title', 'Tambah Mentor')

@section('content')
    <h1 class="text-3xl font-bold text-secondary10 text-center">DASHBOARD ADMIN</h1>
    <p class="mt-2 text-xl font-bold text-white">Tambah Mentor</p>

    <form action="{{ route('mentor.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-netral50 p-6 rounded-xl mt-4 flex flex-col relative">
            <div class=" m-8">
                <div>
                    <label class="block text-sm font-medium">Foto</label>
                    <div class="flex items-center mt-2">
                        <div class="w-[100px] h-[100px] bg-white border rounded-lg flex items-center justify-center overflow-hidden">
                            <img id="previewImage" class="w-full h-full object-cover hidden" />
                        </div>
                        <!-- Input File -->
                        <label class="flex ml-2 px-3 py-1 bg-primary50 text-white text-sm font-semibold rounded cursor-pointer mt-[70px]">
                            Pilih Foto
                            <input type="file" name="foto" class="hidden" id="imageInput" accept="image/*">
                        </label>
                    </div>
                </div>

                <!-- Nama dan URL Telegram -->
                <div class=" mt-4 grid grid-cols-2">
                    <div class="w-auto mr-2">
                        <label class="block text-sm font-medium">Nama</label>
                        <input type="text" id="nama_mentor" name="nama_mentor" class="w-full p-2 border rounded-md bg-transparent" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">URL Tele</label>
                        <input type="text" id="chat" name="chat" class="w-full p-2 border rounded-md bg-transparent" required>
                    </div>
                </div>

                <!-- Kategori -->
                <div class="mt-4">
                    <label class="block text-sm font-medium">Kategori</label>
                    <select id="id_jurusan" name="id_jurusan" class="w-full p-2 border rounded-md bg-transparent">
                        <option value="">Pilih Kategori</option>
                        @foreach ($jurusan as $jrs)
                            <option value="{{ $jrs->id }}">{{ $jrs->jurusan }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Deskripsi -->
                <div class="mt-4">
                    <label class="block text-sm font-medium">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="w-full p-2 border rounded-md h-24 bg-transparent" required></textarea>
                </div>
            </div>

            <!-- Tombol Simpan -->
            <div class=" absolute bottom-4 right-4">
                <button class="px-4 py-2 bg-secondary50 text-white rounded-full" type="submit">Simpan</button>
            </div>
        </div>
    </form>

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
