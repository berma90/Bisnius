<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusans';
    protected $fillable = ['jurusan'];

    public function mentors()
    {
        return $this->hasMany(Mentor::class, 'id_jurusan');
    }
}
