@extends(Auth::check() ? 'layouts.navbar.navbarprofile' : 'layouts.navbar.navbaruser')

@section('title', 'Home')

@section('content')
{{-- intro --}}
<div class="container mx-auto pt-20">
    <div class=" bg-primary50 text-white rounded-2xl p-10">
        <div class=" grid grid-cols-2  items-center">
            <div>
                <h1 class="text-5xl font-bold">BRIGHTEN YOUR LIFE</h1>
                <h2 class="text-4xl font-bold">WITH OUR BUSINESS</h2>
                <p class="mt-10 text-lg">
                    <strong>BISNIUS</strong> merupakan aplikasi masa depan Anda, dengan
                    course-course berkualitas yang dapat memandu Anda bagaimana cara berbisnis
                    seperti layaknya profesional.
                </p>
            </div>
            <div class=" flex justify-center">
                <img src="/img/gambarkananbaru.png" alt="Work From Home" class="">
            </div>
        </div>
        <div class="flex justify-center mt-6 space-x-16">
            <img src="/img/telkom.png" alt="Telkom Indonesia" class="h-20">
            <img src="/img/pertamina.png" alt="Pertamina" class="h-20">
            <img src="/img/google.png" alt="Google" class="h-20">
            <img src="/img/kai.png" alt="KAI" class="h-20">
        </div>
    </div>

    {{-- classpromosi --}}
    <div class="max-w-7xl pl-2 bg-white text-black rounded-lg">
    <div class="flex flex-col md:flex-row items-center justify-between">
        <div class="md:w-4/8">
            <h2 class="text-5xl font-bold text-center md:text-left">Ingin Memulai Bisnis?</h2>
            <p class="mt-4 text-2xl text-gray-700">
                Platform ini menyediakan pembelajaran mendalam terhadap bisnis berdasarkan bidang bisnis yang ingin dikembangkan sesuai keinginan pengguna, kelas-kelas tersebut dibagi menjadi dua golongan yaitu <span class="font-bold">Universal & Jurusan</span>.
            </p>
            <p class="mt-4 text-2xl font-bold">Tunggu apa lagi? yuk mulai belajar dan telusuri bisnis yang bisa dikembangkan dari dirimu!</p>
        </div>
        <div class="md:w-2/5 flex justify-center mt-6 md:mt-0">
            <img src="img/peoplemoney.png" alt="Bisnis Illustration" class="max-w-xs rounded-lg">
        </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div class="border rounded-lg p-6 text-center shadow-md">
            <img src="img/iconbuku.png" alt="Class Universal" class="mx-auto h-12 mb-4">
            <h3 class="font-bold">Class Universal</h3>
            <a href="/classuniversal" class=" text-primary50">See Course</a>
        </div>
        <div class="border rounded-lg p-6 text-center shadow-md">
            <img src="img/iconbuku.png" alt="Class Teknik Jaringan Komputer" class="mx-auto h-12 mb-4">
            <h3 class="font-bold">Class Teknik Jaringan Komputer</h3>
            <a href="/class-jur" class="text-primary50">See Course</a>
        </div>
        <div class="border rounded-lg p-6 text-center shadow-md">
            <img src="img/iconbuku.png" alt="Class Multimedia" class="mx-auto h-12 mb-4">
            <h3 class="font-bold">Class Multimedia</h3>
            <a href="#" class="text-primary50">See Course</a>
        </div>
    </div>
    <a href="/class">
        <p class="text-center mt-6 text-primary50 font-bold cursor-pointer">See All Class</p>
    </a>
    </div>
</div>
</div>

<!-- Master Teacher Section -->
<div class="max-w-8xl mx-auto w-full pl-36 pr-36 pt-20 pb-20 bg-primary50 text-white mt-12">
    <h2 class="text-center text-3xl font-bold">Master Teacher Berpengalaman</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-16 mt-12">
        <div class="bg-white text-black rounded-lg shadow-md p-6 text-center">
            <img src="img/mentoradhi.png" alt="Teacher" class="mx-auto rounded-lg h-40">
            <h3 class="font-bold mt-4">Adhi S.Kom</h3>
            <p class="text-gray-600">Networking</p>
            <a href=""><button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Contact Me</button></a>
        </div>
        <div class="bg-white text-black rounded-lg shadow-md p-6 text-center">
            <img src="img/mentoradhi.png" alt="Teacher" class="mx-auto rounded-lg h-40">
            <h3 class="font-bold mt-4">Adhi S.Kom</h3>
            <p class="text-gray-600">Networking</p>
            <a href=""><button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Contact Me</button></a>
        </div>
        <div class="bg-white text-black rounded-lg shadow-md p-6 text-center">
            <img src="img/mentoradhi.png" alt="Teacher" class="mx-auto rounded-lg h-40">
            <h3 class="font-bold mt-4">Adhi S.Kom</h3>
            <p class="text-gray-600">Networking</p>
            <a href=""><button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Contact Me</button></a>
        </div>
        <div class="bg-white text-black rounded-lg shadow-md p-6 text-center">
            <img src="img/mentoradhi.png" alt="Teacher" class="mx-auto rounded-lg h-40">
            <h3 class="font-bold mt-4">Adhi S.Kom</h3>
            <p class="text-gray-600">Networking</p>
            <a href=""><button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Contact Me</button></a>
        </div>
    </div>
</div>

<!-- Business Benefits Section -->
<div class="max-w-6xl mx-auto text-black mt-20">
    <div class="flex justify-between">
        <div class="w-1/2 pb-4">
            <h2 class="text-5xl font-bold text-left">Kenapa harus belajar bisnis di bisnius?</h2>
        </div>
        <div class="w-1/2">
            <h2 class="text-5xl font-bold text-right">Apa yang akan didapatkan?</h2>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t-2 border-gray-300 pt-4">
        <div class="text-left text-xl border-r-2 border-gray-300 pr-4">
            <ul class="mt-4 space-y-2">
                <li class="flex items-center"><img src="img/iconplus.png" class="h-6 mr-2">Menyediakan mentor mentor berpengalaman</li>
                <li class="flex items-center"><img src="img/iconplus.png" class="h-6 mr-2">Dapat diakses kapan dan dimana saja</li>
                <li class="flex items-center"><img src="img/iconplus.png" class="h-6 mr-2">Murah, mudah dan cepat mendapat materi</li>
            </ul>
        </div>
        <div class="text-right pl-4 text-xl">
            <ul class="mt-4 space-y-2">
                <li class="flex items-center justify-end"><span class="mr-2">Sertifikat pemahaman materi</span><img src="img/iconplus.png" class="h-6"></li>
                <li class="flex items-center justify-end"><span class="mr-2">Relasi antar pebisnis</span><img src="img/iconplus.png" class="h-6"></li>
                <li class="flex items-center justify-end"><span class="mr-2">Materi pembelajaran dari orang orang sukses</span><img src="img/iconplus.png" class="h-6"></li>
            </ul>
        </div>
    </div>
</div>

{{-- footer --}}
<footer class=" bg-primary50 text-white py-16 mt-20">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <img src="img/logofooter.png" alt="Bisnius Logo" class="h-15 mb-4">
            <div class="flex items-center">
                <img src="img/location.png" alt="Location Icon" class="h-6 mr-2">
                <p>Jl. Dopang Raya No.131 Ds. Sidokerto, RT.3/RW.2, Ngagul, Winong, Kec. Pati, Kabupaten Pati, Jawa Tengah 59111.</p>
            </div>
            <h3 class="mt-4 font-bold text-xl">Sosial Media</h3>
            <div class="flex space-x-6 mt-2">
                <a href="#"><img src="img/instagram.png" alt="Instagram" class="h-10"></a>
                <a href="#"><img src="img/x.png" alt="X" class="h-10"></a>
                <a href="#"><img src="img/linkind.png" alt="LinkedIn" class="h-10"></a>
            </div>
        </div>
        <div class="space-y-2 ml-10">
            <h3 class="font-bold text-xl">Home</h3>
            <ul class="space-y-1 text-lg">
                <li><a href="">Tentang Kami</a></li>
                <li><a href="">Class</a></li>
                <li><a href="">Mentor</a></li>
                <li><a href="">Benefit</a></li>
            </ul>
        </div>
        <div class="space-y-2">
            <h3 class="font-bold text-xl">Bantuan & Panduan</h3>
            <ul class="space-y-1 text-lg">
                <li><a href="">Syarat & Ketentuan</a></li>
                <li><a href="">Kebijakan Privasi</a></li>
                <li><a href="">Bantuan</a></li>
            </ul>
        </div>
        <div class="space-y-2">
            <h3 class="font-bold text-xl">Hubungi Kami</h3>
            <div class="flex items-center text-lg">
                <img src="img/email.png" alt="Email Icon" class="h-6 mr-2">
                <p>itcenterpati@gmail.com</p>
            </div>
            <div class="flex items-center">
                <img src="img/telepon.png" alt="Phone Icon" class="h-6 mr-2">
                <p>+6282136222216</p>
            </div>
        </div>
    </div>
    <div class="text-center mt-8">
        <p>&copy; 2025 Bisnius.id</p>
    </div>
</footer>
@endsection
