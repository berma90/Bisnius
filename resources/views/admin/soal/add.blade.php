@extends('layouts.navbar.sidebar')

@section('title', 'Tambah Soal')

@section('content')
    @if (session('error'))
        <div class=" bg-red-500 text-white p-3 rounded-md mb-4">
            {{ session('error') }}
        </div>
    @endif

    <h1 class="text-3xl font-bold text-secondary10 text-center">DASHBOARD ADMIN</h1>
    <p class="mt-2 text-xl font-bold text-white">Tambah Soal</p>

    <form action="{{ route('soal.store', $id) }}" method="POST">
        @csrf
        <div class="mt-4 w-full border-collapse bg-netral50 rounded-lg overflow-hidden h-[550px] relative">
            <div class="m-8">
                <div>
                    <label class="block font-medium">Pertanyaan</label>
                    <input type="text" name="pertanyaan" class="w-full p-2 border rounded-md bg-transparent" required>
                </div>

                <div class="mt-4">
                    <p class="font-medium">Pilihan Jawaban</p>

                    <div class="grid grid-cols-2">
                        <div class="mt-4 mr-3">
                            <label class="block text-sm font-medium">Jawaban 1</label>
                            <input type="text" name="pilihan1" id="pilihan1" class="w-full p-2 border rounded-md bg-transparent" required oninput="updateDropdown()">
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium">Jawaban 2</label>
                            <input type="text" name="pilihan2" id="pilihan2" class="w-full p-2 border rounded-md bg-transparent" required oninput="updateDropdown()">
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="mt-4 mr-3">
                            <label class="block text-sm font-medium">Jawaban 3</label>
                            <input type="text" name="pilihan3" id="pilihan3" class="w-full p-2 border rounded-md bg-transparent" required oninput="updateDropdown()">
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium">Jawaban 4</label>
                            <input type="text" name="pilihan4" id="pilihan4" class="w-full p-2 border rounded-md bg-transparent" required oninput="updateDropdown()">
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block font-medium">Jawaban Benar</label>
                    <select name="correct" id="correct" class="w-full p-2 border rounded-md bg-transparent" required>
                        <option value="">Pilih Jawaban Benar</option>
                        <option value="{{ old('pilihan1', request('pilihan1')) }}">{{ old('pilihan1', request('pilihan1')) ?: 'Jawaban 1' }}</option>
                        <option value="{{ old('pilihan2', request('pilihan2')) }}">{{ old('pilihan2', request('pilihan2')) ?: 'Jawaban 2' }}</option>
                        <option value="{{ old('pilihan3', request('pilihan3')) }}">{{ old('pilihan3', request('pilihan3')) ?: 'Jawaban 3' }}</option>
                        <option value="{{ old('pilihan4', request('pilihan4')) }}">{{ old('pilihan4', request('pilihan4')) ?: 'Jawaban 4' }}</option>
                    </select>
                </div>
            </div>

            <!-- Tombol Simpan di kanan bawah -->
            <div class="absolute bottom-4 right-4">
                <button class="px-4 py-2 bg-secondary50 text-white rounded-full" type="submit">Simpan</button>
            </div>

            <div class="absolute bottom-4 left-4">
                <a href="{{ route('admin.soal', $quiz->id) }}" class="bg-gray-500 text-white px-4 py-2 rounded-full hover:bg-gray-600 transition">
                    ← Back
                </a>
            </div>
        </div>
    </form>

    <script>
        function updateDropdown() {
            const pilihan1 = document.getElementById("pilihan1").value.trim();
            const pilihan2 = document.getElementById("pilihan2").value.trim();
            const pilihan3 = document.getElementById("pilihan3").value.trim();
            const pilihan4 = document.getElementById("pilihan4").value.trim();
            const dropdown = document.getElementById("correct");

            dropdown.innerHTML = '<option value="">Pilih Jawaban Benar</option>'; // Reset opsi

            if (pilihan1) dropdown.innerHTML += `<option value="${pilihan1}">${pilihan1}</option>`;
            if (pilihan2) dropdown.innerHTML += `<option value="${pilihan2}">${pilihan2}</option>`;
            if (pilihan3) dropdown.innerHTML += `<option value="${pilihan3}">${pilihan3}</option>`;
            if (pilihan4) dropdown.innerHTML += `<option value="${pilihan4}">${pilihan4}</option>`;
        }

        document.addEventListener("DOMContentLoaded", updateDropdown);
    </script>
@endsection
