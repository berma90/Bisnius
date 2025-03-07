<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MidtransController extends Controller
{
    public function __construct() {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function pay(Request $request) {
        $user = Auth::user();
        $paket = $request->paket;
        $harga = $this->getHarga($paket);
        $kd_order = Str::uuid();

        $tanggal_beli = Carbon::now();
        $tanggal_tenggat = $tanggal_beli->copy()->addDays($this->getHari($paket));

        $transaksi = Transaksi::create([
            'id_user' => $user->id,
            'kd_order' => $kd_order,
            'tanggal_beli' => $tanggal_beli,
            'tanggal_tenggat' => $tanggal_tenggat,
            'paket' => $paket,
            'harga' => $harga,
            'status' => 'pending'
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $kd_order,
                'gross_amount' => $harga,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);
        dd($snapToken);
        return response()->json(['token' => $snapToken]);
    }

    private function getHarga($paket) {
        $hargaList = [
            '7 DAYS' => 250000,
            '3 MONTH' => 750000,
            '1 YEAR' => 1660000
        ];
        return $hargaList[$paket] ?? 0;
    }

    private function getHari($paket) {
        $hariList = [
            '7 DAYS' => 7,
            '3 MONTH' => 90,
            '1 YEAR' => 365
        ];
        return $hariList[$paket] ?? 0;
    }
}

