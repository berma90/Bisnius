<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sertifikat extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_user',
        'fk_quiz',
        'fk_dataquiz',
        'path'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'fk_quiz');
    }

    public function dataquiz()
    {
        return $this->belongsTo(Dataquiz::class, 'fk_dataquiz');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user');
    }
}
