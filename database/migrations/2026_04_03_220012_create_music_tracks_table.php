<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── Add zip_file to music_releases ──────────────
        Schema::table('music_releases', function (Blueprint $table) {
            $table->string('zip_file')->nullable()->after('cover_art');
        });

        // ── Create music_tracks ──────────────────────────
        Schema::create('music_tracks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('music_release_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->unsignedSmallInteger('track_number')->default(1);
            $table->string('title');
            $table->string('audio_file');          // stored path e.g. music/tracks/xyz.mp3
            $table->unsignedInteger('duration')->nullable(); // seconds, filled on upload
            $table->timestamps();

            $table->index(['music_release_id', 'track_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('music_tracks');
        Schema::table('music_releases', function (Blueprint $table) {
            $table->dropColumn('zip_file');
        });
    }
};