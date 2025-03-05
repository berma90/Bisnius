@extends('layouts.navbar.navbarout')

@section ('content')
<div class="flex  bg-gray-100">
<div class="flex bg-white rounded-lg w-full p-6">
    <!-- Sidebar -->
    <div class="w-1/4 border-r p-4 border border-black rounded-lg ml-12">
        <div class="flex flex-col items-center">
            <div class="relative">
                <a href="/profileU"><img src="/images/prim-prof.png" alt="Profil" class="w-20 h-20 rounded-full border"></a>
            </div>
            <p class="mt-2 font-bold">{{ Auth::user()->name }}</p>
        </div>
        <div class="mt-6">
            <a href="editprof" class="flex items-center p-2 text-primary50 font-semibold bg-gray-200 rounded-md">
                <span class="mr-2"><img src="{{asset('/images/prof.png')}}" alt="" class="text-primary50"></span> Profil
            </a>
            <a href="dtdiri" class="flex items-center p-2 mt-2 text-gray-700 font-semibold hover:text-primary50">
                <span class="mr-2"><img src="{{asset('/images/prof.png')}}" alt=""></span> Data Pribadi
            </a>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="w-3/4 p-6 mx-4">
        <h2 class="text-2xl font-semibold border-b border-black pb-2 mb-4">Profil Pengguna</h2>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')
            <div class="mt-4">
                <label class="block text-gray-600">Nama</label>
                <input id="name" name="name" type="text" value="{{ Auth::user()->name }}" class="w-full font-semibold p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="mt-4">
                <label class="block text-gray-600">Jurusan</label>
                <select id="jurusan" name="jurusan" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="tjkt" {{ old('jurusan', Auth::user()->jurusan) == 'tjkt' ? 'selected' : '' }}>Teknik Jaringan Komputer dan Telekomunikasi</option>
                    <option value="dkv" {{ old('jurusan', Auth::user()->jurusan) == 'dkv' ? 'selected' : '' }}>Desain Komunikasi Visual</option>
                    <option value="tkr" {{ old('jurusan', Auth::user()->jurusan) == 'tkr' ? 'selected' : '' }}>Teknik Kendaraan Ringan Otomotif</option>
                    <option value="tpm" {{ old('jurusan', Auth::user()->jurusan) == 'tpm' ? 'selected' : '' }}>Teknik Pemesinan</option>
                </select>
            </div>            
            <div class="mt-4">
                <label class="block text-gray-600">Email</label>
                <input type="email" value="{{ Auth::user()->email}}" class="w-full p-2 border rounded-md bg-gray-200" disabled>
            </div>
        <button class="py-1 mt-4 px-3 bg-primary50 text-white text-md rounded-md">Simpan</button>
        </form>
        @if(session('success'))
            <div class="p-2 mb-4 text-green-600 bg-green-100 rounded-md">
            {{ session('success') }}
            </div>
        @endif

    </div>
</div>
</div>


@endsection
