<?php

// app/Http/Controllers/PaymentController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
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
