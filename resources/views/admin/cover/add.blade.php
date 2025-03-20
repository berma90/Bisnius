@extends('layouts.navbar.sidebar')

@section('title', 'Tambah Cover')

@section('content')
    @if(session('success'))
        <div class="bg-green-500 w-[500px] text-white p-4 rounded-md mt-2">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class=" bg-red-500 text-white p-3 rounded-md mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class=" bg-red-500 text-white p-3 rounded-md mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 class="text-2xl font-bold text-white text-center">DASHBOARD ADMIN</h1>
    <div class="flex flex-row items-center justify-between px-3 py-3  rounded-lg">
        <!-- Kiri -->
        <div class="flex flex-row items-center gap-4">
            <p class="text-lg font-bold text-white">Tambah Cover</p>

        </div>
    </div>


    <div class="flex p-4">
        <div class="bg-netral50 rounded-xl w-full  p-6">

            <form method="POST" action="{{route('cover.store')}}" enctype="multipart/form-data">
                @csrf
            <!-- Form -->
            <div class="space-y-4">
                <!-- Input Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" id="judul" name="judul" class="w-full border border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Input Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select id="fk_jurusan" name="fk_jurusan" class="w-full border border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Pilih Kategori</option>
                        @foreach($jurusan as $jurus)
                            <option value="{{ $jurus->id }}">{{ $jurus->jurusan }}</option>
                        @endforeach
                    </select>

                </div>

                <!-- Input Thumbnail -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Thumbnail</label>
                    <input type="file" id="thumbnail" name="thumbnail" accept="image/*" class="w-full  rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>


                <!-- Dropdown Nama Mentor -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Mentor</label>
                    <select id="mentor" name="fk_mentor" class="w-full border border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Pilih Kategori</option>
                        @foreach($mentor as $mentors)
                            <option value="{{ $mentors->id }}">{{ $mentors->nama_mentor }}</option>
                        @endforeach
                    </select>
                </div>

                
            </div>

            <!-- Tombol Simpan -->
            <div class="flex justify-end mt-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm">Simpan</button>
            </div>

            </form>

        </div>
    </div>
@endsection
