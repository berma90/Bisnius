@extends('layouts.navbar.sidebar')

@section('title', 'Data Soal')

@section('content')
    @if (session('success'))
        <div class="bg-green-600 text-white p-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @elseif (session('warning'))
        <div class="bg-yellow-500 text-white p-3 rounded-md mb-4">
            {{ session('warning') }}
        </div>
    @endif

    <h1 class="text-3xl font-bold text-secondary10 text-center">DASHBOARD ADMIN</h1>
    <p class="mt-2 text-xl font-bold text-white">Data Soal</p>

    <div class="bg-white p-6 rounded-lg shadow-md mt-4">
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <div>
                <h3 class="text-lg font-bold">{{ $quiz->judul }}</h3>
                <p class="text-gray-600">{{ $quiz->cover->judul }}</p>
            </div>
            <div>
                <p class="text-gray-600">Mentor</p>
                <p class="font-semibold">{{ $quiz->mentor->nama_mentor }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('quiz.edit', $quiz->id) }}" class="bg-yellow-400 text-black px-4 py-1 rounded-full hover:bg-yellow-500 transition">Edit</a>

                @if ($quiz->soal->count() < 10)
                    <a href="{{ route('soal.create', $quiz->id) }}" class="bg-secondary50 text-white px-4 py-1 rounded-full hover:bg-blue-600 transition">Add Questions</a>
                @else
                    <span class="text-gray-500 text-sm">Maksimal 10 soal telah tercapai</span>
                @endif
            </div>
        </div>

        <p class="m-4">Total Soal: {{ $quiz->soal->count() }}</p>

        <div class="space-y-2">
            @foreach ($quiz->soal as $index => $soal)
                <div class="flex justify-between items-center bg-gray-100 p-3 rounded-lg">
                    <div class="flex flex-col">
                        <p>{{ $index + 1 }}. {{ $soal->pertanyaan }}</p>
                        <div class="flex gap-4 mt-2 text-sm text-gray-700">
                            <span class="bg-gray-200 px-2 py-1 rounded-md">A. {{ $soal->pilihan1 }}</span>
                            <span class="bg-gray-200 px-2 py-1 rounded-md">B. {{ $soal->pilihan2 }}</span>
                            <span class="bg-gray-200 px-2 py-1 rounded-md">C. {{ $soal->pilihan3 }}</span>
                            <span class="bg-gray-200 px-2 py-1 rounded-md">D. {{ $soal->pilihan4 }}</span>
                        </div>
                        <p class="mt-2 text-sm font-semibold text-green-600">Jawaban Benar: {{ $soal->correct }}</p>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('soal.edit', $soal->id) }}" class="bg-yellow-400 text-black px-4 py-1 rounded-full hover:bg-yellow-500 transition">Edit</a>
                        <form action="{{ route('soal.delete', $soal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus soal ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded-full hover:bg-red-600 transition">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
