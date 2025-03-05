@extends('layouts.navbar.navbarprofile')

@section('content')
    <div class="w-full">
        <!-- Search Bar -->
        <div class="w-full">
            @include('layouts.navbar.search')
        </div>


        <p class="text-3xl font-bold m-4 p-2">Kelas Universal</p>

        <div class="flex flex-row items-center">
        <!-- Grid Container -->
            <div class="mt-4 mb-3">
                <div class="grid grid-cols-4 gap-3">
                    <div class="p-4 mx-3 bg-card rounded-2xl shadow-shadow shadow-md flex flex-col ">
                        <img src="{{ asset('images/class.png') }}" alt="">
                        <p class="text-lg px-4 text-center py-2">Apa yang dimaksud bisnis?</p>
                        <p class="text-lg px-4 text-center">From: Adhi S.kom</p>
                    </div>
                    <div class="p-4 mx-3 bg-card rounded-2xl shadow-shadow shadow-md flex flex-col ">
                        <img src="{{ asset('images/class.png') }}" alt="">
                        <p class="text-lg px-4 text-center py-2">Apa yang dimaksud bisnis?</p>
                        <p class="text-lg px-4 text-center">From: Adhi S.kom</p>
                    </div>
                    <div class="p-4 mx-3 bg-card rounded-2xl shadow-shadow shadow-md flex flex-col ">
                        <img src="{{ asset('images/class.png') }}" alt="">
                        <p class="text-lg px-4 text-center py-2">Apa yang dimaksud bisnis?</p>
                        <p class="text-lg px-4 text-center">From: Adhi S.kom</p>
                    </div>
                    <div class="p-4 mx-3 bg-card rounded-2xl shadow-shadow shadow-md flex flex-col ">
                        <img src="{{ asset('images/class.png') }}" alt="">
                        <p class="text-lg px-4 text-center py-2">Apa yang dimaksud bisnis?</p>
                        <p class="text-lg px-4 text-center">From: Adhi S.kom</p>
                    </div>     
                </div>
            </div>
            <div class="flex items-center justify-center ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="p-1" width="56" height="56" viewBox="0 0 56 56" fill="none">
                    <path d="M14 14L28 28L14 42M28 14L42 28L28 42" stroke="#05415F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
        
        <p class="text-3xl font-bold m-4 p-2">Teknik Komputer Jaringan</p>

        <div class="flex flex-row items-center">
        <!-- Grid Container -->
            <div class="mt-4 mb-3">
                <div class="grid grid-cols-4 gap-3">
                    <div class="p-4 mx-3 bg-card rounded-2xl shadow-shadow shadow-md flex flex-col ">
                        <img src="{{ asset('images/jaringan.png') }}" alt="">
                        <p class="text-lg px-4 text-center py-2">Apa yang dimaksud bisnis?</p>
                        <p class="text-lg px-4 text-center">From: Adhi S.kom</p>
                    </div>
                    <div class="p-4 mx-3 bg-card rounded-2xl shadow-shadow shadow-md flex flex-col ">
                        <img src="{{ asset('images/jaringan.png') }}" alt="">
                        <p class="text-lg px-4 text-center py-2">Apa yang dimaksud bisnis?</p>
                        <p class="text-lg px-4 text-center">From: Adhi S.kom</p>
                    </div>
                    <div class="p-4 mx-3 bg-card rounded-2xl shadow-shadow shadow-md flex flex-col ">
                        <img src="{{ asset('images/jaringan.png') }}" alt="">
                        <p class="text-lg px-4 text-center py-2">Apa yang dimaksud bisnis?</p>
                        <p class="text-lg px-4 text-center">From: Adhi S.kom</p>
                    </div>
                    <div class="p-4 mx-3 bg-card rounded-2xl shadow-shadow shadow-md flex flex-col ">
                        <img src="{{ asset('images/jaringan.png') }}" alt="">
                        <p class="text-lg px-4 text-center py-2">Apa yang dimaksud bisnis?</p>
                        <p class="text-lg px-4 text-center">From: Adhi S.kom</p>
                    </div>     
                </div>
            </div>
            <div class="flex items-center justify-center ml-4">
                <a href="/jur" class="group">
                <svg xmlns="http://www.w3.org/2000/svg" class="p-1" width="56" height="56" viewBox="0 0 56 56" fill="none">
                    <path d="M14 14L28 28L14 42M28 14L42 28L28 42" stroke="#05415F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                </a>
            </div>
        </div>
    </div>
@endsection
