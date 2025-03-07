@extends('layouts.navbar.navbarprofile')

@section('content')
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
            <button class="beli-paket bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mt-4" 
                    data-paket="{{ $paket[0] }}">
                Beli Paket
            </button>
        </div>
        @endforeach
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
document.querySelectorAll(".beli-paket").forEach(button => {
    button.addEventListener("click", function() {
        let paket = this.getAttribute("data-paket");

        fetch("{{ route('pay') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ paket: paket })
        })
        .then(response => response.json())
        .then(data => {
            if (data.token) {
                snap.pay(data.token);
            } else {
                alert("Gagal mendapatkan token pembayaran.");
            }
        })
        .catch(error => console.error("Error:", error));
    });
});
</script>
@endsection
