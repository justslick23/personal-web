<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadLog extends Model
{
    protected $fillable = ['music_release_id', 'music_track_id', 'type', 'ip'];
}