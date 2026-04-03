<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class MusicRelease extends Model
{
    protected $fillable = [
        'title',
        'type',
        'year',
        'note',
        'cover_art',
        'zip_file',
        'soundcloud_url',
        'spotify_url',
        'apple_music_url',
        'youtube_url',
        'is_featured',
        'is_uma_winner',
        'sort_order',
        'initials',
    ];

    protected $casts = [
        'year'         => 'integer',
        'sort_order'   => 'integer',
        'is_featured'  => 'boolean',
        'is_uma_winner'=> 'boolean',
    ];

    // ── Relationships ───────────────────────────────

    public function tracks(): HasMany
    {
        return $this->hasMany(MusicTrack::class)->orderBy('track_number');
    }

    // ── Accessors ───────────────────────────────────

    public function getCoverArtUrlAttribute(): ?string
    {
        if (!$this->cover_art) return null;
        if (str_starts_with($this->cover_art, 'http')) return $this->cover_art;
        return asset('storage/' . $this->cover_art);
    }

    public function getZipUrlAttribute(): ?string
    {
        if (!$this->zip_file) return null;
        return asset('storage/' . $this->zip_file);
    }

    /**
     * Types that can have multiple tracks (tracklist UI).
     */
    public function getIsMultiTrackAttribute(): bool
    {
        return in_array($this->type, ['EP', 'Album', 'Compilation', 'Beat Tape', 'Mixtape']);
    }
}