@extends('layouts.navbar.sidebaradm')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold text-primary50">DASHBOARD ADMIN</h1>
    <p class="mt-8 text-lg font-bold">Data User</p>

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
                        <td class="border border-gray-300 px-4 py-2">{{ $users->username }}</td>
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