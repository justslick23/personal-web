<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');              // 'Graphic Design' | 'Software Dev'
            $table->text('description')->nullable();
            $table->string('tags')->nullable();      // comma-separated
            $table->string('link')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->string('image')->nullable();     // storage path or URL
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_items');
    }
};