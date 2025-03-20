@extends('user.profile')

@section('history_content')
<div class="p-5 bg-white rounded-lg shadow-md">
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="border p-3 text-left">No</th>
                    <th class="border p-3 text-left">ID Transaksi</th>
                    <th class="border p-3 text-left">Jenis</th>
                    <th class="border p-3 text-left">Tanggal Masuk</th>
                    <th class="border p-3 text-left">Tanggal Tenggat</th>
                    <th class="border p-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($transactions as $index => $t)
                    <tr class="border">
                        <td class="border p-3">{{ $index + 1 }}</td>
                        <td class="border p-3">{{ crc32($t->kd_order) }}</td> <!-- Ubah UUID ke angka -->
                        <td class="border p-3">Premium</td>
                        <td class="border p-3">{{ date('d-m-Y', strtotime($t->tanggal_beli)) }}</td>
                        <td class="border p-3">{{ date('d-m-Y', strtotime($t->tanggal_tenggat)) }}</td>
                        <td class="border p-3 font-semibold
                            {{ $t->status == 'paid' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $t->status == 'paid' ? 'SUCCESS' : 'FAILED' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
