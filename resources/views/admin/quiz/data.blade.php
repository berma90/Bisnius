@extends('layouts.navbar.sidebar')

@section('title', 'Data Quiz')

@section('content')
    @if (session('success'))
            <div class=" bg-green-600 text-white p-3 rounded-md mb-4">
                {{ session('success') }}
            </div>
    @elseif (session('warning'))
        <div class=" bg-yellow-500 text-white p-3 rounded-md mb-4">
            {{ session('warning') }}
        </div>
    @elseif (session('error'))
        <div class=" bg-red-500 text-white p-3 rounded-md mb-4">
            {{ session('error') }}
        </div>
    @endif

    <h1 class="text-3xl font-bold text-secondary10 text-center">DASHBOARD ADMIN</h1>

    <div class="flex mt-2">
        <p class="mt-2 text-xl font-bold text-white">Data Quiz</p>
        <a href="{{ route('quiz.create') }}" class=" bg-secondary50 text-white text-sm px-4 py-2 ml-5 mt-1 rounded-3xl hover:bg-blue-700 transition">Add Quiz</a>
    </div>

    <table class="mt-4 w-full border-collapse bg-white rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 border text-left">No</th>
                <th class="p-3 border text-left">Judul</th>
                <th class="p-3 border text-left">Kategori</th>
                <th class="p-3 border text-left">Nama Mentor</th>
                <th class="p-3 border text-left">Jumlah Soal</th>
                <th class="p-3 border text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quizzes as $index => $quiz)
            <tr class="border-b">
                <td class="p-3 border">{{ $index + 1 }}</td>
                <td class="p-3 border">{{ $quiz->judul }}</td>
                <td class="p-3 border">{{ $quiz->cover->judul }}</td>
                <td class="p-3 border">{{ $quiz->mentor->nama_mentor }}</td>
                <td class="p-3 border">{{ $quiz->soal->count() }}</td>
                <td class=" flex p-3 border text-center gap-2 justify-center">
                    <a href="{{ route('admin.soal', ['id' => $quiz->id]) }}" class="bg-yellow-400 text-black px-4 py-1 rounded-full hover:bg-yellow-500 transition">Manage</a>
                    <form action="{{ route('quiz.delete', $quiz->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus quiz ini? Semua soal juga akan terhapus!');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-full hover:bg-red-600 transition">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
