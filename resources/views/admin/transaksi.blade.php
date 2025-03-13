@extends('layouts.navbar.sidebar')

@section('title', 'Data User')

@section('content')

<div class="container mx-auto p-6">
    <!-- Judul Dashboard -->
    <h1 class="text-3xl font-bold text-white text-center mb-6">DASHBOARD ADMIN</h1>

    <!-- Transaksi User -->
    <div class=" bg-gray200 p-6 rounded-lg">
        <h3 class="font-bold text-white text-2xl mb-4">Transaksi User</h3>
        <div class=" shadow-lg">
            <table class="w-full rounded-xl border-collapse border border-gray-300">
                <thead class="bg-gray-300">
                    <tr>
                        <th class=" px-4 py-2 text-left">No</th>
                        <th class=" px-4 py-2 text-left">ID Transaksi</th>
                        <th class=" px-4 py-2 text-left">User</th>
                        <th class=" px-4 py-2 text-left">Jenis</th>
                        <th class=" px-4 py-2 text-left">Tanggal Masuk</th>
                        <th class=" px-4 py-2 text-left">Tanggal Tenggat</th>
                        <th class=" px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $key => $data)
                    <tr class="bg-white">
                        <td class=" px-4 py-2">{{ $key + 1 }}</td>
                        <td class=" px-4 py-2">#{{ $data->kd_order }}</td>
                        <td class=" px-4 py-2">{{ $data->user->name ?? 'Unknown' }}</td>
                        <td class=" px-4 py-2">{{ ucfirst($data->paket) }}</td>
                        <td class=" px-4 py-2">{{ \Carbon\Carbon::parse($data->tanggal_beli)->format('d-m-Y') }}</td>
                        <td class=" px-4 py-2">{{ \Carbon\Carbon::parse($data->tanggal_tenggat)->format('d-m-Y') }}</td>
                        <td class="border-gray-300 px-4 py-2">
                            @if (strtolower($data->status) == 'paid')
                                <span class="text-green-500 font-semibold">{{ strtoupper($data->status) }}</span>
                            @elseif (strtolower($data->status) == 'pending')
                                <span class="text-yellow-500 font-semibold">{{ strtoupper($data->status) }}</span>
                            @elseif (strtolower($data->status) == 'gagal')
                                <span class="text-red-500 font-semibold">{{ strtoupper($data->status) }}</span>
                            @else
                                <span class="text-gray-500 font-semibold">{{ strtoupper($data->status) }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
