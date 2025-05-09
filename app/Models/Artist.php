<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'bio'];

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'artist_song');
    }
    

    public function albums()
    {
        return $this->belongsToMany(Album::class);
    }
}
