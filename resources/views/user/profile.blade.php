@extends('layouts.navbar.navbarout')

@section('content')
<div class="bg-primary50 w-full h-60 flex justify-start items-center">
    <div class="d flex justify-center items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="bg-white ml-24 rounded-full" width="70" height="70" viewBox="0 0 63 64" fill="none">
            <path opacity="0.4" d="M31.5 58.2762C45.9975 58.2762 57.75 46.5237 57.75 32.0262C57.75 17.5288 45.9975 5.77625 31.5 5.77625C17.0025 5.77625 5.25 17.5288 5.25 32.0262C5.25 46.5237 17.0025 58.2762 31.5 58.2762Z" fill="#292D32"/>
            <path d="M31.5 18.7175C26.0663 18.7175 21.6562 23.1275 21.6562 28.5613C21.6562 33.89 25.83 38.2213 31.3687 38.3788C31.4475 38.3788 31.5525 38.3788 31.605 38.3788C31.6575 38.3788 31.7362 38.3788 31.7887 38.3788C31.815 38.3788 31.8413 38.3788 31.8413 38.3788C37.1438 38.195 41.3175 33.89 41.3438 28.5613C41.3438 23.1275 36.9338 18.7175 31.5 18.7175Z" fill="#05415F"/>
            <path d="M49.2975 51.32C44.625 55.625 38.3775 58.2763 31.5 58.2763C24.6225 58.2763 18.375 55.625 13.7025 51.32C14.3325 48.9313 16.0388 46.7525 18.5325 45.0725C25.6988 40.295 37.3538 40.295 44.4675 45.0725C46.9875 46.7525 48.6675 48.9313 49.2975 51.32Z" fill="#05415F"/>
        </svg>
    </div>
    <div class="flex flex-col">
        <p class="flex text-white text-2xl ml-8 mb-1 font-semibold">{{ Auth::user()->name }}</p>
        <p class="flex text-white text-xl ml-8 mb-1">{{ Auth::user()->jurusan }}</p>

        @if(Auth::user()->is_premium)
            <p class="flex text-white text-lg ml-8 mb-1 font-semibold">Akun Premium</p>
        @else
            <p class="flex text-white text-lg ml-8 mb-1 font-semibold">Akun Free</p>
        @endif
    </div>
</div>

<div class="flex space-x-6 mx-5 mt-2">
    <a href="{{ route('profilC') }}"
        class="px-4 py-2 rounded-full transition font-medium text-xl
        {{ request()->routeIs('profilC') ? 'text-primary50 border-b-2 border-primary50' : 'text-gray-700 hover:text-primary50' }}">
        Class
    </a>
    <a href="{{ route('profilT') }}"
        class="px-4 py-2 rounded-full transition font-medium text-xl
        {{ request()->routeIs('profilT') ? 'text-primary50 border-b-2 border-primary50' : 'text-gray-700 hover:text-primary50' }}">
        Transaction
    </a>
    <a href="{{ route('profilA') }}"
        class="px-4 py-2 rounded-full transition font-medium text-xl
        {{ request()->routeIs('profilA') ? 'text-primary50 border-b-2 border-primary50' : 'text-gray-700 hover:text-primary50' }}">
        Appreciate
    </a>
</div>

<div class="mt-4">
    @yield('history_content')
</div>

{{-- Langsung Menampilkan History Class
<div class="p-5 w-[1100px] mt-6">
    <h2 class="text-xl font-semibold mb-4">Class History</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach ($history as $h)
            <div class="border rounded-lg shadow p-4 flex space-x-4">
                <div class="w-10 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                    <img src="{{ asset('storage/' . $h->cover->thumbnail) }}" alt="Thumbnail"
                         class="w-full h-full object-cover rounded-lg">
                </div>
                <div class="">
                    <h3 class="text-lg font-semibold">{{ $h->cover->judul }}</h3>
                    <p class="text-gray-500 text-sm mb-2">Tanggal: {{ $h->created_at->format('d M Y') }}</p>
                    <a href="{{ route('cover.show', $h->id) }}" class="mt-2 bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">Lihat Kelas</a>
                </div>
            </div>
        @endforeach
    </div>
</div> --}}

@endsection
