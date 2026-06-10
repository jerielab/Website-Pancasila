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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->integer('total_score');
            $table->decimal('total_percentage', 5, 2);
            // Sila 1 scores
            $table->integer('sila1_score');
            $table->decimal('sila1_percentage', 5, 2);
            $table->string('sila1_category');
            // Sila 2 scores
            $table->integer('sila2_score');
            $table->decimal('sila2_percentage', 5, 2);
            $table->string('sila2_category');
            // Sila 3 scores
            $table->integer('sila3_score');
            $table->decimal('sila3_percentage', 5, 2);
            $table->string('sila3_category');
            // Sila 4 scores
            $table->integer('sila4_score');
            $table->decimal('sila4_percentage', 5, 2);
            $table->string('sila4_category');
            // Sila 5 scores
            $table->integer('sila5_score');
            $table->decimal('sila5_percentage', 5, 2);
            $table->string('sila5_category');
            // Store answers as JSON
            $table->json('answers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
