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
                $baseSlug = Str::slug($song->title);
                $slug = $baseSlug;
                $counter = 1;
    
                while (Song::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }
    
                $song->slug = $slug;
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
