<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SongStatistics extends Model
{

    protected $fillable = ['song_id', 'views', 'downloads', 'plays'];

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
