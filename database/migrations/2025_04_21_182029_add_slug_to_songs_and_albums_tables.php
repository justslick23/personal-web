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
        // Add slug field to songs table
        Schema::table('songs', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('title');  // Add slug column
        });

        // Add slug field to albums table
        Schema::table('albums', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('title');  // Add slug column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Drop slug field from songs table
        Schema::table('songs', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        // Drop slug field from albums table
        Schema::table('albums', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
