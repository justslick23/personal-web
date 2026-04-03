<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('music_releases', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');                      // Single | EP | Album | Compilation | Beat Tape | Mixtape
            $table->unsignedSmallInteger('year')->nullable();
            $table->string('note')->nullable();          // e.g. "UMA Winner · Best Compilation"
            $table->string('initials', 4)->nullable();   // auto-generated e.g. "DD"
            $table->string('cover_art')->nullable();
            $table->string('soundcloud_url')->nullable();
            $table->string('spotify_url')->nullable();
            $table->string('apple_music_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_uma_winner')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('music_releases');
    }
};