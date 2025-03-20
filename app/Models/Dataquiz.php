<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dataquiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_user',
        'fk_quiz',
        'fk_soal',
        'jawaban',
        'is_correct',
        'score',
    ];

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'fk_soal');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user');
    }
    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class, 'fk_dataquiz');
    }
}
