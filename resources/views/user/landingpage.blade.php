@extends(Auth::check() ? 'layouts.navbar.navbarprofile' : 'layouts.navbar.navbaruser')

@section('title', 'Home')

@section('content')
    {{-- intro --}}
    <div class="container pt-20">
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
        <div class="max-w-7xl mx-auto bg-white text-black rounded-lg flex flex-col items-center">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <!-- Kolom 1 - Text -->
                <div class="md:w-3/5">
                    <h2 class="text-5xl font-bold text-center md:text-left">Ingin Memulai Bisnis?</h2>
                    <p class="mt-4 text-2xl text-gray-700">
                        Platform ini menyediakan pembelajaran mendalam terhadap bisnis berdasarkan bidang bisnis yang ingin dikembangkan sesuai keinginan pengguna, kelas-kelas tersebut dibagi menjadi dua golongan yaitu <span class="font-bold">Universal & Jurusan</span>.
                    </p>
                    <p class="mt-4 text-2xl font-bold">Tunggu apa lagi? yuk mulai belajar dan telusuri bisnis yang bisa dikembangkan dari dirimu!</p>
                </div>

                <!-- Kolom 2 - Gambar -->
                <div class="md:w-2/5 flex justify-end mt-6 md:mt-0">
                    <img src="img/peoplemoney.png" alt="Bisnis Illustration" class="max-w-xs rounded-lg">
                </div>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="border rounded-lg p-6 text-center shadow-md">
                    <img src="img/iconbuku.png" alt="Class Teknik Jaringan Komputer" class="mx-auto h-12 mb-4">
                    <h3 class="font-bold">Class Teknik Jaringan Komputer</h3>
                    <a href="/class?search=&filter=1" class=" text-primary50">See Course</a>
                </div>
                <div class="border rounded-lg p-6 text-center shadow-md">
                    <img src="img/iconbuku.png" alt="Class Multimedia" class="mx-auto h-12 mb-4">
                    <h3 class="font-bold">Class Multimedia</h3>
                    <a href="/class?search=&filter=2" class="text-primary50">See Course</a>
                </div>
                <div class="border rounded-lg p-6 text-center shadow-md">
                    <img src="img/iconbuku.png" alt="Class Kimia" class="mx-auto h-12 mb-4">
                    <h3 class="font-bold">Class Kimia</h3>
                    <a href="/class?search=&filter=3" class="text-primary50">See Course</a>
                </div>
            </div>
                <a href="/class">
                    <p class="text-center mt-6 text-primary50 font-bold cursor-pointer">See All Class</p>
                </a>
            </div>
        </div>

        <!-- Master Teacher Section -->
        <div class="max-w-8xl w-full pl-36 pr-36 pt-20 pb-20 bg-primary50 text-white mt-12">
            <h2 class="text-center text-3xl font-bold">Master Teacher Berpengalaman</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-12">
                @foreach ($mentors as $mentor)
                    <div class="bg-white text-black rounded-3xl shadow-md p-6 text-center justify-center">
                        <img src="{{ asset('storage/' . $mentor->foto) }}" alt="{{ $mentor->nama_mentor }}" class="mx-auto rounded-lg w-[200px] h-[200px] object-cover">
                        <h3 class="font-bold text-xl mt-4">{{ $mentor->nama_mentor }}</h3>
                        <div class="w-[240px] h-[55px] flex items-center justify-center">
                            <h5 class="font-bold text-sm mt-2">{{ $mentor->jurusan->jurusan }}</h5>
                        </div>
                        <div class="flex-grow"></div>
                        @if($mentor->is_premium)
                    <!-- Jika mentor premium, tampilkan tombol dengan link chat -->
                    <a href="{{ $mentor->chat }}" class="mt-auto w-full">
                        <button class="bg-secondary30 text-white px-4 py-2 rounded-full w-full">
                            Contact Me
                        </button>
                    </a>
                    @else
                        <!-- Jika mentor bukan premium, tampilkan tombol yang membuka modal -->
                        <button onclick="openModal()" class="bg-secondary30 text-white px-4 py-2 rounded-full w-full">
                            Contact Me
                        </button>
                    @endif
                    </div>
                @endforeach
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
    </div>

    {{-- footer --}}
    <footer class=" bg-primary90 text-white py-16 mt-20">
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

    <!-- Modal Peringatan -->
    <div id="alertModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h2 class="text-xl font-semibold text-gray-800">Fitur Terkunci</h2>
            <p class="text-gray-600 mt-2">Silakan upgrade ke akun premium untuk mengakses fitur ini.</p>
            <div class="flex justify-end mt-4">
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-400 text-white rounded-lg mr-2">Tutup</button>
                <a href="/buypremium" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Upgrade Sekarang</a>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Modal -->
    <script>
        function openModal() {
            document.getElementById("alertModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("alertModal").classList.add("hidden");
        }
    </script>
@endsection
