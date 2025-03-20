@extends(Auth::check() ? 'layouts.navbar.navbarprofile' : 'layouts.navbar.navbaruser')

@section('title', 'Mentor')

@section('content')
    <!-- Include Search & Filter -->
    @include('layouts.navbar.search')

    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Mentor</h2>

        @if ($mentors->isEmpty())
            <p class="text-gray-500 text-lg text-center">Tidak ada mentor yang ditemukan.</p>
        @else
            @php
                $groupedMentors = $mentors->groupBy('jurusan.jurusan');
            @endphp

            @foreach ($groupedMentors as $jurusan => $mentorList)
                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-3">{{ $jurusan ?? 'Tanpa Jurusan' }}</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($mentorList as $mentor)
                        <a href="{{ $mentor->chat }}" class="ml-auto">
                            <div class="bg-white shadow-md rounded-lg overflow-hidden border-2 border-secondary50 p-4">
                                <div class="flex items-center gap-4">
                                    <img src="{{ asset('storage/' . $mentor->foto) }}" class=" rounded-full w-[100px] h-[50px] object-cover" alt="Mentor Image">
                                    <div>
                                        <div class="grid grid-cols-2 mb-3">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800">{{ $mentor->nama_mentor }}</h3>
                                                <p class="text-sm text-gray-600 w-[200px]">{{ $mentor->jurusan?->jurusan }}</p>
                                            </div>
                                                <div class=" flex justify-end">
                                                    <svg width="50" height="50" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.315 19.6324C13.1061 19.5783 13.8906 19.4519 14.6587 19.2549C15.6074 19.5401 16.6088 19.6046 17.5863 19.4436C17.6253 19.4389 17.6645 19.436 17.7038 19.4349C18.0525 19.4349 18.51 19.6349 19.1775 20.0561V19.3636C19.1778 19.243 19.2104 19.1246 19.272 19.0209C19.3335 18.9171 19.4218 18.8317 19.5275 18.7736C19.8183 18.6095 20.0871 18.4249 20.3337 18.2199C21.3062 17.4074 21.855 16.3224 21.855 15.1749C21.855 14.7961 21.795 14.4186 21.6762 14.0586C21.9712 13.5161 22.2063 12.9499 22.3813 12.3599C22.9438 13.1911 23.2462 14.1724 23.25 15.1749C23.25 16.7349 22.515 18.1899 21.2412 19.2536C21.0279 19.4311 20.805 19.5945 20.5725 19.7436V21.3661C20.5725 21.9236 19.92 22.2449 19.46 21.9124C19.0242 21.5917 18.5737 21.2914 18.11 21.0124C17.9761 20.9352 17.8375 20.8663 17.695 20.8061C17.308 20.8634 16.9174 20.8923 16.5263 20.8924C14.9388 20.8924 13.4712 20.4211 12.315 19.6324ZM3.91375 16.3886C1.90875 14.7099 0.75 12.4211 0.75 9.96864C0.75 4.95864 5.54 0.952393 11.3888 0.952393C17.2387 0.952393 22.03 4.95739 22.03 9.96864C22.03 14.9786 17.2387 18.9836 11.3888 18.9836C10.7313 18.9836 10.0833 18.9336 9.445 18.8336C9.17 18.8974 8.0675 19.5436 6.48 20.6874C5.905 21.1024 5.09 20.7024 5.09 20.0036V17.2374C4.67828 16.9829 4.28558 16.6988 3.915 16.3874M9.48375 17.1274C9.53208 17.1274 9.58083 17.1311 9.63 17.1386C10.205 17.2336 10.7913 17.2816 11.3888 17.2824C16.33 17.2824 20.2838 13.9761 20.2838 9.96739C20.2838 5.95989 16.33 2.65364 11.39 2.65364C6.45 2.65364 2.49375 5.96239 2.49375 9.96864C2.49375 11.9061 3.41875 13.7311 5.05125 15.0974C5.46292 15.4407 5.91125 15.7491 6.39625 16.0224C6.52781 16.0954 6.63764 16.202 6.7145 16.3314C6.79137 16.4607 6.83252 16.6082 6.83375 16.7586V18.3536C8.09 17.5224 8.91625 17.1274 9.48375 17.1274Z" fill="white"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <p class=" justify-center">{{$mentor->deskripsi}}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>
@endsection
