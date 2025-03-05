@extends('layouts.navbar.navbarprofile')

@section('content')
    <div class="w-full"> 
        <!-- Search Bar -->
        <div class="w-full">
            @include('layouts.navbar.search')
        </div>

        <p class="text-3xl font-bold m-4 p-2">Kelas Jurusan</p>

        <!-- Grid Container -->
        <div class="mt-4">
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
    </div>
@endsection
