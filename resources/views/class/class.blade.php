@extends('layouts.navbar.navbarout')


@section ('content')

  
@include('layouts.navbar.navbar-profile')

            <div class="grid grid-cols-2 gap-5 mx-5 mt-3">
                <div class="border border-primary50 p-3 shadow-md rounded-2xl">
                    <div class="flex flex-row ">
                        <div class="flex">
                        <img src="{{ asset('images/universal.png') }}" alt="Logo" width="200">
                        </div>
                        <div class="flex flex-col ml-3">
                            <p class="text-lg font-bold">Class Universal</p>
                            <p class="text-lg">Hai,Selamat datang di Kelas saya.
                                Disini saya akan membimbing anda 
                                untuk belajar tentang bisnis</p>
                                <div class="flex justify-between items-center mt-5">
                                    <p class="text-lg">from: Adhi</p>
                                    <button class="py-1 px-3 bg-primary50 text-white text-md rounded-md">Lihat Kelas</button>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="border border-primary50 p-3 shadow-md rounded-2xl">
                    <div class="flex flex-row ">
                        <div class="flex">
                        <img src="{{ asset('images/jur.png') }}" alt="Logo" width="200">
                        </div>
                        <div class="flex flex-col ml-3">
                            <p class="text-lg font-bold">Class Universal</p>
                            <p class="text-lg">Hai,Selamat datang di Kelas saya.
                                Disini saya akan membimbing anda 
                                untuk belajar tentang bisnis</p>
                                <div class="flex justify-between items-center mt-5">
                                    <p class="text-lg">from: Adhi</p>
                                    <button class="py-1 px-3 bg-primary50 text-white text-md rounded-md">Lihat Kelas</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            
@endsection