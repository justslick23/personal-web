<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class MusicTrack extends Model
{
    protected $fillable = [
        'music_release_id',
        'track_number',
        'title',
        'audio_file',
        'duration',
    ];

    protected $casts = [
        'track_number' => 'integer',
        'duration'     => 'integer',
    ];

    // ── Relationships ───────────────────────────────

    public function release(): BelongsTo
    {
        return $this->belongsTo(MusicRelease::class, 'music_release_id');
    }

    // ── Accessors ───────────────────────────────────

    /**
     * Full public URL to the audio file.
     */
    public function getAudioUrlAttribute(): string
    {
        return asset('storage/' . $this->audio_file);
    }

    /**
     * Human-readable duration e.g. "3:42"
     */
    public function getDurationFormattedAttribute(): string
    {
        if (!$this->duration) return '—';
        $m = intdiv($this->duration, 60);
        $s = $this->duration % 60;
        return $m . ':' . str_pad($s, 2, '0', STR_PAD_LEFT);
    }
}