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
        Schema::create('marvel_heroes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('marvel_id');
            $table->longText('description');
            $table->string('image_url');
            $table->integer('votes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marvel_heroes');
    }
};
