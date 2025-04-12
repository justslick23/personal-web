<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('music', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the song or album
            $table->string('artist');
            $table->string('album')->nullable(); // Nullable because not all songs will belong to an album
            $table->enum('type', ['song', 'album']);
            $table->string('file_path')->nullable(); // File path for songs
            $table->string('cover_image')->nullable(); // Cover image for albums
            $table->timestamps();
        });
    
        // Create a songs table to link songs to an album (if type is album)
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->nullable()->constrained('music'); // Foreign key linking song to album
            $table->string('name'); // Song name
            $table->string('file_path'); // Song file
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music');
    }
};
