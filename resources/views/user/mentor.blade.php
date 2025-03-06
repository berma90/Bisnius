@extends('layouts.navbar.navbaruser')


@section('content')
<div class="w-full">
    <!-- Search Bar -->
    <div class="w-full">
        @include('layouts.navbar.search')
    </div>


    <p class="text-3xl font-bold m-4 p-2">Kelas Universal</p>

    <div class="grid h-48 grid-cols-2 place-content-stretch gap-4 ...">
        <div class="p-4 mx-3 bg-card rounded-2xl hover:shadow-md hover:shadow-shadow border-shadow border-2 flex flex-col ">
            <img src="{{ asset('images/adhi.jpg') }}" class="rounded-full w-20 h-20" alt="">
            <p class="text-lg px-4 text-center py-2">Apa yang dimaksud bisnis?</p>
            <p class="text-lg px-4 text-center">From: Adhi S.kom</p>
        </div>
        <div>02</div>
        <div>03</div>
        <div>04</div>
      </div>
    

@endsection
