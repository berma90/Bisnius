<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_user',
        'fk_cover',
        'viewed_at'
    ];

    public function cover()
    {
        return $this->belongsTo(Cover::class, 'fk_cover');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user');
    }
}
