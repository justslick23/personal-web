<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_path',
        'album_id',
    ];

    // Relationship: Each song belongs to an album
    public function album()
    {
        return $this->belongsTo(Music::class, 'album_id');
    }
}
