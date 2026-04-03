<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PortfolioItem extends Model
{
    protected $fillable = [
        'title',
        'category',
        'description',
        'tags',
        'link',
        'year',
        'image',
        'sort_order',
    ];

    protected $casts = [
        'year'       => 'integer',
        'sort_order' => 'integer',
    ];

    // ── Accessors ──────────────────────────────────

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return 'https://placehold.co/800x600/161616/00e676?text=' . urlencode($this->title);
        }
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        return Storage::disk('public')->url($this->image);
    }

    public function getTagsArrayAttribute(): array
    {
        if (!$this->tags) return [];
        return array_map('trim', explode(',', $this->tags));
    }

    // ── Scopes ─────────────────────────────────────

    public function scopeDesign($query)
    {
        return $query->where('category', 'Graphic Design');
    }

    public function scopeDev($query)
    {
        return $query->where('category', 'Software Dev');
    }
}