<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model {
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'id_user',
        'kd_order',
        'tanggal_beli',
        'tanggal_tenggat',
        'paket',
        'harga',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}

