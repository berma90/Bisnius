@extends('layouts.navbar.navbarprofile')

@section('content')

    <div class="container text-center">
        <h1>Proses Pembayaran</h1>
        <button id="pay-button" class="btn btn-success">Bayar Sekarang</button>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        document.getElementById('pay-button').addEventListener('click', function () {
            snap.pay("{{ $snapToken }}");
        });
    </script>

@endsection