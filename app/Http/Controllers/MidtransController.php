<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class MidtransController extends Controller
{
    public function __construct() {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

public function pay(Request $request) {
    Log::info('Request diterima:', $request->all());

    $user = Auth::user();
    if (!$user) {
        Log::error('User tidak ditemukan.');
        return response()->json(['error' => 'User tidak ditemukan.'], 401);
    }

    $paket = $request->paket;
    $harga = $this->getHarga($paket);
    $kd_order = Str::uuid();

    if ($harga <= 0) {
        Log::error('Paket tidak valid:', ['paket' => $paket]);
        return response()->json(['error' => 'Paket tidak valid.'], 400);
    }

    $tanggal_beli = Carbon::now();
    $tanggal_tenggat = $tanggal_beli->copy()->addDays($this->getHari($paket));

    // Simpan ke database
    $transaksi = Transaksi::create([
        'id_user' => $user->id,
        'kd_order' => $kd_order,
        'tanggal_beli' => $tanggal_beli,
        'tanggal_tenggat' => $tanggal_tenggat,
        'paket' => $paket,
        'harga' => $harga,
        'status' => 'pending'
    ]);

    Log::info('Transaksi berhasil dibuat:', $transaksi->toArray());

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

    try {
        $snapToken = Snap::getSnapToken($params);
        Log::info('Snap Token berhasil didapatkan:', ['token' => $snapToken]);
        return response()->json(['token' => $snapToken]);
    } catch (\Exception $e) {
        Log::error('Gagal mendapatkan token Midtrans:', ['error' => $e->getMessage()]);
        return response()->json(['error' => 'Gagal mendapatkan token pembayaran.'], 500);
    }
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

    public function callback(Request $request) {
    $data = $request->input();
    
    Log::info('Callback Data:', $data);

    if (empty($data)) {
        return response()->json(['message' => 'No data received'], 400);
    }

    $order_id = $data['order_id'] ?? null;
    $status_code = $data['status_code'] ?? null;
    $transaction_status = $data['transaction_status'] ?? null;
    $gross_amount = $data['gross_amount'] ?? null;
    $signature_key = $data['signature_key'] ?? null;


    if (!$order_id || !$status_code || !$transaction_status || !$gross_amount || !$signature_key) {
        Log::error('Invalid data received: ', $data);
        return response()->json(['message' => 'Invalid Data'], 400);
    }

    $serverKey = env('MIDTRANS_SERVER_KEY');
    $expectedSignature = hash("sha512", $order_id . $status_code . $gross_amount . $serverKey);

    Log::info("Signature Dihitung: $expectedSignature");
    Log::info("Signature Midtrans: $signature_key");

    if ($expectedSignature !== $signature_key) {
        Log::warning('Invalid signature untuk order_id: ' . $order_id);
        return response()->json(['message' => 'Invalid Signature'], 403);
    }

    $transaksi = Transaksi::where('kd_order', $order_id)->first();
    if (!$transaksi) {
        Log::error('Transaksi tidak ditemukan untuk order_id: ' . $order_id);
        return response()->json(['message' => 'Transaction Not Found'], 404);
    }

    Log::info('Status pembayaran diterima dari Midtrans: ' . $transaction_status);

    // Update status transaksi berdasarkan status dari Midtrans
    if (in_array($transaction_status, ['capture', 'settlement'])) {
        $transaksi->status = 'paid';

        // Jika transaksi sukses, jadikan user premium
        if ($transaksi->user) {
            $transaksi->user->is_premium = true;
            $transaksi->user->save();
            Log::info('User ' . $transaksi->user->email . ' telah menjadi premium.');
        }

        Log::info('Transaksi berhasil diperbarui ke PAID: ' . $order_id);

    } elseif ($transaction_status === 'pending') {
        $transaksi->status = 'pending';

    } elseif (in_array($transaction_status, ['deny', 'cancel', 'expire'])) {
        $transaksi->status = 'failed';

    } elseif (in_array($transaction_status, ['refund', 'chargeback'])) {
        $transaksi->status = 'refunded';
    }

    $transaksi->save();
    Log::info('Transaction updated: ' . $order_id . ' | Status: ' . $transaksi->status);

    return response()->json(['message' => 'Transaction updated'], 200);
}

public function handleCallback(Request $request)
    {
        $transaction = $request->input('transaction_status'); // Status dari Midtrans / Payment Gateway
        $orderId = $request->input('order_id'); // Ambil ID order
        $userId = $request->input('user_id'); // ID user yang bayar

        // Jika pembayaran sukses
        if ($transaction == 'settlement' || $transaction == 'success') {
            // Update status user jadi premium
            $user = User::find($userId);
            if ($user) {
                $user->is_premium = true;
                $user->save();
            }

            // Redirect ke halaman Class Universal
            return redirect('/class-universal')->with('success', 'Selamat! Anda telah menjadi member premium.');
        }

        return redirect('/')->with('error', 'Pembayaran gagal, silakan coba lagi.');
    }
}