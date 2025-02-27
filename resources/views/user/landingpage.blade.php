

@section('title', 'Home')

@if(Auth::check())
    @include('layouts.navbar.navbarprofile') <!-- Navbar untuk user yang sudah login -->
@else
    @include('layouts.navbar.navbaruser') <!-- Navbar untuk user yang belum login -->
@endif


@section('content')
    <h1>Selamat Datang di Home</h1>
@endsection
