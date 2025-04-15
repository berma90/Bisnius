@extends('layouts.navbar.navbarout')

@section ('content')
<div class="flex  bg-gray-100">
<div class="flex bg-white rounded-lg w-full p-6">
    <!-- Sidebar -->
    <div class="w-1/4 border-r p-4 border border-black rounded-lg ml-12">
        <div class="flex flex-col items-center">
            <div class="relative">
               <a href="/profile"> <img src="/images/prim-prof.png" alt="Profil" class="w-20 h-20 rounded-full border"> </a>
            </div>
            <p class="mt-2 font-bold">{{ Auth::user()->name }}</p>
        </div>
        <div class="mt-6">
            <a href="editprof" class="flex items-center p-2  text-gray-700 font-semibold ">
                <span class="mr-2"><img src="{{asset('/images/prof.png')}}" alt="" class="text-primary50"></span> Profil
            </a>
            <a href="dtdiri" class="flex items-center p-2 mt-2  text-primary50 font-semibold bg-gray-200 rounded-md hover:text-primary50">
                <span class="mr-2"><img src="{{asset('/images/prof.png')}}" alt=""></span> Data Pribadi
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="mx-4 p-6 bg-white shadow-sm rounded-md">
        <h2 class="text-2xl font-semibold border-b border-black pb-2 mb-4">Data Pribadi</h2>

        <form action="{{ route('profile.updatedtr') }}" method="POST">
            @csrf
            @method('PUT')
        <!-- No. Telepon -->
        <div class="mb-4">
            <label class="block text-gray-600">No. Telepon</label>
            <input id="no_telepon" name="no_telepon" type="number" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <!-- Tanggal Lahir -->
            <div>
                <label class="block text-gray-600">Tanggal Lahir</label>
                <div class="relative">
                    <input type="date" id="tgl_lahir" name="tgl_lahir" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <!-- Pendidikan Terakhir -->
            <div>
                <label class="block text-gray-600 mx-3">Pendidikan terakhir</label>
            <select id="pendidikan_terakhir" name="pendidikan_terakhir" class="w-full p-2 mx-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="tunas">SMK Tunas Harapan</option>
                <option value="sma">SMAN 1</option>
                <option value="smk">SMK 1</option>
            </select>
            </div>
        </div>

        <!-- Jenis Kelamin -->
        <div class="mt-4">
            <label class="block text-gray-600">Jenis Kelamin</label>
            <div class="flex flex-col space-y-2">
                <label class="flex items-center space-x-2">
                    <input type="radio" name="jenis_kelamin" value="Laki-Laki" class="form-radio text-blue-600"> Laki-Laki
                    <input type="radio" name="jenis_kelamin" value="Perempuan" class="form-radio text-blue-600"> Perempuan
                    <input type="radio" name="jenis_kelamin" value="Tidak ingin mengungkapkan" class="form-radio text-blue-600"> Tidak ingin mengungkapkan
                </label>
            </div>
        </div>
        <button class="py-1 mt-4 px-3 bg-primary50 text-white text-md rounded-md">Simpan</button>
        @if(session('success'))
            <div class="p-2 mb-4 text-green-600 bg-green-100 rounded-md">
            {{ session('success') }}
            </div>
        @endif
        </form>
    </div>
</div>



@endsection
