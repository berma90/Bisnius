@extends('layouts.navbar.navbarout')


@section ('content')

@include('layouts.navbar.navbar-profile')
<div class="flex">
    <div class="overflow-x-auto w-full mx-[70px] mt-3 p-2 rounded-xl border border-primary50 bg-slate-200">
        <table class="w-full border-collapse border rounded-lg overflow-hidden">
            <thead class="border-b-2 border-gray-500 w-1/2 mx-auto my-4">
                <tr class="bg-gray-200 ">
                    <th class="border px-4 py-2 text-left">No</th>
                    <th class="border px-4 py-2 text-left">ID Transaksi</th>
                    <th class="border px-4 py-2 text-left">Jenis</th>
                    <th class="border px-4 py-2 text-left">Tanggal Masuk</th>
                    <th class="border px-4 py-2 text-left">Tanggal Tenggat</th>
                    <th class="border px-4 py-2 text-left">Status</th>
                </tr>

            </thead>
            <tbody>
                <!-- Baris 1 -->
                <tr class="border ">
                    <td class=" px-4 py-2">1</td>
                    <td class=" px-4 py-2">#123814797304</td>
                    <td class=" px-4 py-2">Premium</td>
                    <td class=" px-4 py-2">01-01-2025</td>
                    <td class=" px-4 py-2">01-03-2025</td>
                    <td class=" px-4 py-2 text-green-500 font-semibold">SUCCESS</td>
                </tr>
            </tbody>
        </table>
    </div>    
</div>



@endsection