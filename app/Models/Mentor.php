<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Mentor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mentor',
        'chat',
        'id_jurusan',
        'deskripsi',
        'foto',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
    public function cover()
    {
        return $this->hasMany(Cover::class, 'fk_mentor');
    }
    public function quiz()
    {
        return $this->hasMany(Quiz::class, 'fk_mentor');
    }
}

