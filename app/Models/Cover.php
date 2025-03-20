<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    use HasFactory;

    protected $table = 'covers';

    protected $fillable = [
        'judul',
        'thumbnail',
        'mentor',
        'fk_mentor',
        'fk_jurusan'
    ];
    public function jurusan()
    {
        return $this->belongsTo(jurusan::class,'fk_jurusan');
    }
    public function materi()
    {
        return $this->hasMany(Materi::class,'fk_cover');
    }
    public function mentor()
    {
        return $this->belongsTo(Mentor::class,'fk_mentor');
    }
    public function quiz()
    {
        return $this->hasMany(Quiz::class, 'fk_cover');
    }
    public function history()
    {
        return $this->hasMany(History::class, 'fk_cover');
    }
}
