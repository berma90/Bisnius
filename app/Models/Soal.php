<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Soal extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_quiz',
        'pertanyaan',
        'pilihan1',
        'pilihan2',
        'pilihan3',
        'pilihan4',
        'correct',
    ];
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'fk_quiz');
    }

    public function dataQuiz()
    {
        return $this->hasMany(Dataquiz::class, 'fk_soal');
    }
}
