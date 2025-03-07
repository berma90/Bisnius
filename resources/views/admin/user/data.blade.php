@extends('layouts.navbar.sidebar')

@section('title', 'Data User')

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
    <p class="mt-2 text-xl font-bold text-white">Data User</p>

    <div class="mt-4 overflow-x-auto overflow-hidden rounded-lg">
        <table class="w-full border-collapse border border-gray-300 bg-white shadow-md rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">No</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Username</th>
                    <th class="border border-gray-300 px-4 py-2">Password</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $index => $users)
                    <tr class="text-center border border-gray-300">
                        <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 px-4 py-2 truncate w-[150px]">{{ $users->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $users->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $users->password }}</td>
                        <td class="border border-gray-300 px-4 py-2 flex justify-center space-x-2">
                            <form action="{{ route('users.destroy', $users->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-3xl">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
