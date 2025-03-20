<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'fk_cover',
        'fk_mentor',
    ];

    public function cover()
    {
        return $this->belongsTo(Cover::class, 'fk_cover');
    }
    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'fk_mentor');
    }
    public function soal()
    {
        return $this->hasMany(Soal::class, 'fk_quiz');
    }
    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class, 'fk_quiz');
    }
}
