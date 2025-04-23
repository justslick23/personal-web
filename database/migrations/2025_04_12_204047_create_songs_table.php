<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file_path'); // audio file
            $table->unsignedBigInteger('album_id')->nullable();
            $table->string('cover_art')->nullable();
            $table->integer('views')->default(0);
            $table->integer('downloads')->default(0);
            $table->integer('plays')->default(0);
            $table->timestamps();
    
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
