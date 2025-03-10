<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusans';
    protected $fillable = ['jurusan'];

    public function mentors()
    {
        return $this->hasMany(Mentor::class, 'id_jurusan');
    }
    public function covers()
    {
        return $this->hasMany(Cover::class,'fk_jurusan');
    }
    public function materis()
    {
        return $this->hasMany(Materi::class, 'fk_jurusan', 'id');

    }
}
