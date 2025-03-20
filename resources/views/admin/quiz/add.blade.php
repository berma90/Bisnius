@extends('layouts.navbar.sidebar')

@section('title', 'Tambah Quiz')

@section('content')
    @if (session('error'))
        <div class=" bg-red-500 text-white p-3 rounded-md mb-4">
            {{ session('error') }}
        </div>
    @endif

    <h1 class="text-3xl font-bold text-secondary10 text-center">DASHBOARD ADMIN</h1>
    <p class="mt-2 text-xl font-bold text-white">Tambah Quiz</p>

    <form action="{{ route('quiz.store') }}" method="POST">
        @csrf

        <div class="mt-4 w-full border-collapse bg-netral50 rounded-lg overflow-hidden h-[550px] relative">
            <div class="m-8">
                <div>
                    <label class="block text-sm font-medium">Quiz Name</label>
                    <input type="text" name="judul" class="w-full p-2 border rounded-md bg-transparent" required>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium">Cover</label>
                    <select name="fk_cover" class="w-full p-2 border rounded-md bg-transparent" required>
                        <option value="">Pilih Cover</option>
                        @foreach ($covers as $cover)
                        <option value="{{ $cover->id }}">{{ $cover->judul }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium">Nama Mentor</label>
                    <select name="fk_mentor" class="w-full p-2 border rounded-md bg-transparent" required>
                        <option value="">Pilih Mentor</option>
                        @foreach ($mentors as $mentor)
                        <option value="{{ $mentor->id }}">{{ $mentor->nama_mentor }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="absolute bottom-4 right-4">
                <button class="px-4 py-2 bg-secondary50 text-white rounded-full" type="submit">Simpan</button>
            </div>
        </div>
    </form>
@endsection
