@extends('layouts.navbar.sidebar')

@section('title', 'Edit Soal')

@section('content')
    @if (session('error'))
        <div class=" bg-red-500 text-white p-3 rounded-md mb-4">
            {{ session('error') }}
        </div>
    @endif

    <h1 class="text-3xl font-bold text-secondary10 text-center">DASHBOARD ADMIN</h1>
    <p class="mt-2 text-xl font-bold text-white">Edit Soal</p>

    <form action="{{ route('soal.update', $soal->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mt-4 w-full border-collapse bg-netral50 rounded-lg overflow-hidden h-[550px] relative">
            <div class="m-8">
                <div>
                    <label class="block font-medium">Pertanyaan</label>
                    <input type="text" name="pertanyaan" value="{{ old('pertanyaan', $soal->pertanyaan) }}" class="w-full p-2 border rounded-md bg-transparent" required>
                </div>

                <div class="mt-4">
                    <p class="font-medium">Pilihan Jawaban</p>
                    <div class="grid grid-cols-2">
                        <div class="mt-4 mr-3">
                            <label class="block text-sm font-medium">Jawaban 1</label>
                            <input type="text" name="pilihan1" id="pilihan1" value="{{ old('pilihan1', $soal->pilihan1) }}" class="w-full p-2 border rounded-md bg-transparent" required oninput="updateDropdown()">
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium">Jawaban 2</label>
                            <input type="text" name="pilihan2" id="pilihan2" value="{{ old('pilihan2', $soal->pilihan2) }}" class="w-full p-2 border rounded-md bg-transparent" required oninput="updateDropdown()">
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="mt-4 mr-3">
                            <label class="block text-sm font-medium">Jawaban 3</label>
                            <input type="text" name="pilihan3" id="pilihan3" value="{{ old('pilihan3', $soal->pilihan3) }}" class="w-full p-2 border rounded-md bg-transparent" required oninput="updateDropdown()">
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium">Jawaban 4</label>
                            <input type="text" name="pilihan4" id="pilihan4" value="{{ old('pilihan4', $soal->pilihan4) }}" class="w-full p-2 border rounded-md bg-transparent" required oninput="updateDropdown()">
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block font-medium">Jawaban Benar</label>
                    <select name="correct" id="correct" class="w-full p-2 border rounded-md bg-transparent" required>
                        <option value="">Pilih Jawaban Benar</option>
                        <option value="{{ $soal->pilihan1 }}" {{ $soal->correct == $soal->pilihan1 ? 'selected' : '' }}>{{ $soal->pilihan1 }}</option>
                        <option value="{{ $soal->pilihan2 }}" {{ $soal->correct == $soal->pilihan2 ? 'selected' : '' }}>{{ $soal->pilihan2 }}</option>
                        <option value="{{ $soal->pilihan3 }}" {{ $soal->correct == $soal->pilihan3 ? 'selected' : '' }}>{{ $soal->pilihan3 }}</option>
                        <option value="{{ $soal->pilihan4 }}" {{ $soal->correct == $soal->pilihan4 ? 'selected' : '' }}>{{ $soal->pilihan4 }}</option>
                    </select>
                </div>
            </div>

            <!-- Tombol Simpan di kanan bawah -->
            <div class="absolute bottom-4 right-4">
                <button class="px-4 py-2 bg-secondary50 text-white rounded-full" type="submit">Simpan</button>
            </div>

            <div class=" absolute bottom-4 left-4">
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

            if (pilihan1) dropdown.innerHTML += `<option value="${pilihan1}" ${pilihan1 === "{{ $soal->correct }}" ? 'selected' : ''}>${pilihan1}</option>`;
            if (pilihan2) dropdown.innerHTML += `<option value="${pilihan2}" ${pilihan2 === "{{ $soal->correct }}" ? 'selected' : ''}>${pilihan2}</option>`;
            if (pilihan3) dropdown.innerHTML += `<option value="${pilihan3}" ${pilihan3 === "{{ $soal->correct }}" ? 'selected' : ''}>${pilihan3}</option>`;
            if (pilihan4) dropdown.innerHTML += `<option value="${pilihan4}" ${pilihan4 === "{{ $soal->correct }}" ? 'selected' : ''}>${pilihan4}</option>`;
        }

        document.addEventListener("DOMContentLoaded", updateDropdown);
    </script>
@endsection
