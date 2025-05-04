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
        Schema::table('songs', function (Blueprint $table) {
            // First, drop the incorrect foreign key constraint
            $table->dropForeign(['album_id']);

            // Then, add the correct foreign key constraint referencing albums
            $table->foreign('album_id')
                  ->references('id')
                  ->on('albums')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('songs', function (Blueprint $table) {
            // Revert to the previous (incorrect) foreign key for rollback
            $table->dropForeign(['album_id']);

            $table->foreign('album_id')
                  ->references('id')
                  ->on('music')
                  ->onDelete('set null');
        });
    }
};
