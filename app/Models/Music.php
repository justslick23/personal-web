<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'artist',
        'album',
        'type',
        'file_path',
        'cover_image',
    ];

    // Relationship: One album has many songs
    public function songs()
    {
        return $this->hasMany(Song::class, 'album_id');
    }
}
