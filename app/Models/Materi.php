<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'path',
        'deskripsi',
        'fk_cover'
    ];

    public function cover()
    {
        return $this->belongsTo(Cover::class, 'fk_cover');
    }

}
