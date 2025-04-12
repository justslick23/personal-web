<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bio',
        'genre',
    ];

    // One artist can have many songs/albums
    public function music()
    {
        return $this->hasMany(Music::class);
    }
}
