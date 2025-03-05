@extends('layouts.navbar.navbaruser')

@section('title', 'Home')

@section('content')
<div class="container mx-auto p-6">
    <!-- Judul Center -->
    <h1 class="text-5xl font-extrabold text-center mb-10">UPGRADE YOUR LICENSE NOW!!</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <!-- Paket 7 Days -->
        <div class="bg-primary50 text-white px-10 py-16 rounded-2xl shadow-lg shadow-blue-400 relative h-[440px] flex flex-col">
            <div class="absolute top-6 right-6 p-3 rounded-full">
                <img src="img/crown.png" alt="Crown Icon" class="w-12 h-12">
            </div>
            <h2 class="text-3xl font-bold mt-16">7 DAYS</h2>
            <p class="text-lg mt-4">Dapatkan akses menonton lebih luas dan ilmu bisnis yang bisa anda dapatkan dari mentor terkenal!</p>
            <p class="text-4xl font-extrabold mt-6">Rp 250.000</p>
            <div class="mt-8 text-center">
                <button class="bg-blue-500 text-white px-8 py-3 rounded-full text-lg font-semibold">Beli Paket</button>
            </div>
        </div>

        <!-- Paket 3 Month -->
        <div class="bg-primary50 text-white px-10 py-16 rounded-2xl shadow-lg shadow-blue-400 relative h-[440px] flex flex-col">
            <div class="absolute top-6 right-6 p-3 rounded-full">
                <img src="img/crown.png" alt="Crown Icon" class="w-12 h-12">
            </div>
            <h2 class="text-3xl font-bold mt-16">3 MONTH</h2>
            <p class="text-lg mt-4">Dapatkan akses menonton lebih luas dan ilmu bisnis yang bisa anda dapatkan dari mentor terkenal!</p>
            <p class="text-4xl font-extrabold mt-6">Rp 750.000</p>
            <div class="mt-8 text-center">
                <button class="bg-blue-500 text-white px-8 py-3 rounded-full text-lg font-semibold">Beli Paket</button>
            </div>
        </div>

        <!-- Paket 1 Year -->
        <div class=" bg-primary50 text-white px-10 py-16 rounded-2xl shadow-lg shadow-blue-400 relative h-[440px] flex flex-col">
            <div class="absolute top-6 right-6 p-3 rounded-full">
                <img src="img/crown.png" alt="Crown Icon" class="w-12 h-12">
            </div>
            <h2 class="text-3xl font-bold mt-16">1 YEAR</h2>
            <p class="text-lg mt-4">Dapatkan akses menonton lebih luas dan ilmu bisnis yang bisa anda dapatkan dari mentor terkenal!</p>
            <p class="text-4xl font-extrabold mt-6">Rp 1.660.000</p>
            <div class="mt-8 text-center">
                <button class="bg-blue-500 text-white px-8 py-3 rounded-full text-lg font-semibold">Beli Paket</button>
            </div>
        </div>
    </div>

    <!-- Footer Center -->
    <p class="text-xl font-semibold mt-10 text-center">See Your Potential Now!</p>
</div>
@endsection
