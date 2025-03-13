<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'kategori',
        'judul',
    ];

    public function cover()
    {
        return $this->hasMany(Cover::class, 'fk_mentor');
    }
}
