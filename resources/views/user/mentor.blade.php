@extends('layouts.navbar.navbarprofile')


@section('content')
<div class="w-full">
    <!-- Search Bar -->
    <div class="w-full">
        @include('layouts.navbar.searchM')
    </div>

<div class="grid pt-4 h-48 grid-cols-2 place-content-stretch gap-20">
    @if ($mentors->isNotEmpty()) <!-- Pastikan data tidak kosong -->
        @foreach ($mentors as $mentor)
            <div class="flex flex-col p-4 mx-3 bg-card rounded-2xl hover:shadow-sm hover:shadow-shadow border-shadow border-2">
                <div class="flex flex-row">
                    <!-- Menampilkan gambar mentor -->
                    <img src="{{ Storage::url($mentor->foto) }}" class="rounded-full w-20 h-20" alt="Mentor Image">

                    <div class="flex flex-col">
                        <p class="text-lg px-3 py-0 pt-2 font-bold">{{ $mentor->nama_mentor }}</p>
                        <p class="text-lg px-3 text-center font-semibold">{{ $mentor->jurusan?->jurusan }}</p>
                    </div>

                    <!-- Perbaikan struktur <a> di dalam <svg> -->
                    <a href="{{ $mentor->chat }}" class="ml-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
                            <rect width="39" height="39" rx="19.5" fill="#05415F"/>
                            <path d="M19.315 27.6325C20.1061 27.5784 20.8906 27.4521 21.6587 27.255C22.6075 27.5402 23.6088 27.6048 24.5863 27.4438C24.6253 27.439 24.6645 27.4361 24.7038 27.435C25.0525 27.435 25.51 27.635 26.1775 28.0563V27.3638C26.1778 27.2431 26.2104 27.1248 26.272 27.021C26.3335 26.9172 26.4218 26.8319 26.5275 26.7738C26.8183 26.6096 27.0871 26.425 27.3337 26.22C28.3062 25.4075 28.855 24.3225 28.855 23.175C28.855 22.7963 28.795 22.4188 28.6762 22.0588C28.9712 21.5163 29.2063 20.95 29.3813 20.36C29.9438 21.1913 30.2463 22.1725 30.25 23.175C30.25 24.735 29.515 26.19 28.2412 27.2538C28.0279 27.4313 27.805 27.5946 27.5725 27.7438V29.3663C27.5725 29.9238 26.92 30.245 26.46 29.9125C26.0242 29.5918 25.5737 29.2915 25.11 29.0125C24.9761 28.9353 24.8375 28.8664 24.695 28.8063C24.308 28.8635 23.9174 28.8924 23.5263 28.8925C21.9388 28.8925 20.4712 28.4213 19.315 27.6325ZM10.9138 24.3888C8.90875 22.71 7.75 20.4213 7.75 17.9688C7.75 12.9588 12.54 8.95251 18.3888 8.95251C24.2387 8.95251 29.03 12.9575 29.03 17.9688C29.03 22.9788 24.2387 26.9838 18.3888 26.9838C17.7312 26.9838 17.0833 26.9338 16.445 26.8338C16.17 26.8975 15.0675 27.5438 13.48 28.6875C12.905 29.1025 12.09 28.7025 12.09 28.0038V25.2375C11.6783 24.983 11.2856 24.6989 10.915 24.3875M16.4838 25.1275C16.5321 25.1275 16.5808 25.1313 16.63 25.1388C17.205 25.2338 17.7912 25.2817 18.3888 25.2825C23.33 25.2825 27.2838 21.9763 27.2838 17.9675C27.2838 13.96 23.33 10.6538 18.39 10.6538C13.45 10.6538 9.49375 13.9625 9.49375 17.9688C9.49375 19.9063 10.4188 21.7313 12.0512 23.0975C12.4629 23.4408 12.9113 23.7492 13.3963 24.0225C13.5278 24.0955 13.6376 24.2022 13.7145 24.3315C13.7914 24.4609 13.8325 24.6083 13.8338 24.7588V26.3538C15.09 25.5225 15.9163 25.1275 16.4838 25.1275Z" fill="white"/>
                        </svg>
                    </a>
                </div>
                <p class="text-lg py-2">{{ $mentor->deskripsi }}</p>
            </div>
        @endforeach
    @else
        <p class="text-lg text-center text-gray-500">Tidak ada mentor yang tersedia.</p>
    @endif
</div>
@endsection