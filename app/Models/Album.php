<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['title', 'description', 'cover_art'];

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }
}
