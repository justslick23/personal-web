<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Song extends Model
{
    protected $fillable = ['title', 'file_path', 'cover_art', 'album_id', 'views', 'downloads', 'slug', 'plays'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($song) {
            if (!$song->slug) {
                $song->slug = Str::slug($song->title);
            }
        });
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'artist_song');
    }
    

    public function songStatistics()
    {
        return $this->hasOne(SongStatistics::class);
    }
}
