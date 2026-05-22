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
        Schema::create('mangas', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('synopsis')->nullable();
            $table->string('author')->nullable()->default('Anónimo');
            $table->string('genre')->nullable();
            $table->integer('volumes')->nullable();
            $table->integer('chapters')->nullable();
            $table->enum('status', ['ongoing', 'completed', 'hiatus', 'cancelled', 'not_yet_released']);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mangas');
    }
};
