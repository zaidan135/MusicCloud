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
        Schema::create('music_details', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('writer');
            $table->string('singer');
            $table->string('composer');
            $table->string('genre');
            $table->text('description')->nullable();
            $table->text('duration');
            $table->date('release_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music_details');
    }
};
