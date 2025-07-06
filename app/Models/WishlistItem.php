<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'url',
        'image',
        'is_received',
        'contribution_link',
    ];

    protected $casts = [
        'is_received' => 'boolean',
        'price' => 'decimal:2',
    ];
}
