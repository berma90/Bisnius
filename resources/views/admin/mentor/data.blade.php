@extends('layouts.navbar.sidebar')

@section('title', 'Data Mentor')

@section('content')

    @if (session('success'))
        <div class=" bg-green-600 text-white p-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @elseif (session('warning'))
    <div class=" bg-yellow-500 text-white p-3 rounded-md mb-4">
        {{ session('warning') }}
    </div>
    @endif

    <h1 class="text-3xl font-bold text-secondary10 text-center">DASHBOARD ADMIN</h1>

    <div class="flex mt-2">
        <p class="mt-2 text-xl font-bold text-white">Data Mentor</p>

        <a href="{{ route('mentor.create') }}" class=" bg-secondary50 text-white text-sm px-4 py-2 ml-5 mt-1 rounded-3xl hover:bg-blue-700 transition">
            Add New
        </a>
    </div>

    <table class="mt-4 w-full border-collapse bg-white rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 border text-left">No</th>
                <th class="p-3 border text-left">Kategori</th>
                <th class="p-3 border text-left">Nama</th>
                <th class="p-3 border text-left">URL Tele</th>
                <th class="p-3 border text-left">Deskripsi</th>
                <th class="p-3 border text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mentor as $key => $mentors)
            <tr class="border-b">
                <td class="p-3 border">{{ $key + 1 }}</td>
                <td class="p-3 border">{{ Str::limit($mentors->jurusan->jurusan, 10, '..') }}</td>
                <td class="p-3 border">{{ Str::limit($mentors->nama_mentor, 15, '..') }}</td>
                <td class="p-3 border">
                    <a href="{{ $mentors->chat }}" target="_blank" class="text-blue-500 hover:underline">
                        {{ Str::limit($mentors->chat, 20, '..') }}
                    </a>
                </td>
                <td class="p-3 border">{{ Str::limit($mentors->deskripsi, 30, '..') }}</td>
                <td class=" flex p-3 border text-center gap-2 justify-center">
                    <a href="{{ route('mentor.edit', $mentors->id) }}" class="bg-yellow-400 text-black px-3 py-1 rounded-full hover:bg-yellow-500 transition">
                        Edit
                    </a>
                    <form action="{{ route('mentor.destroy', $mentors->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-full hover:bg-red-600 transition"
                            onclick="return confirm('Apakah yakin ingin menghapus mentor ini?');">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
