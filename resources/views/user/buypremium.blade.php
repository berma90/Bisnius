@extends('layouts.navbar.navbarprofile')

@section('content')
<script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{config('midtrans.client_key')}}">
</script>
<div class="container mx-auto text-center py-10">
    <h1 class="text-3xl font-bold">UPGRADE YOUR LICENSE NOW!!</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        @foreach ([['7 DAYS', 250000], ['3 MONTH', 750000], ['1 YEAR', 1660000]] as $paket)
        <div class=" bg-primary50 text-white p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold">{{ $paket[0] }}</h2>
                <img src="img/crown.png" alt="Premium" class="w-6">
            </div>
            <p class="mt-2">Dapatkan akses menonton lebih luas dan ilmu bisnis yang bisa anda dapatkan dari mentor terkenal!</p>
            <h3 class="text-2xl font-bold mt-4">Rp {{ number_format($paket[1], 0, ',', '.') }}</h3>
            <button id="pay-button" class="beli-paket bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mt-4"
                    data-paket="{{ $paket[0] }}">
                Beli Paket
            </button>
        </div>
        @endforeach
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    document.getElementById('pay-button').onclick = function () {
        fetch('/pay', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ paket: '7 DAYS' })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Token Midtrans:", data.token);
            if (data.token) {
                window.snap.pay(data.token);
            } else {
                alert("Gagal mendapatkan token pembayaran");
            }
        })
        .catch(error => console.error("Error:", error));
    };
    
    function redirectToClass() {
        setTimeout(function () {
            window.location.href = "/class-universal";
        }, 3000);
    }
</script>

@endsection
