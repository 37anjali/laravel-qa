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
    Schema::create('answers', function (Blueprint $table) {
        $table->id();

        // Foreign keys
        $table->foreignId('question_id')
              ->constrained('questions')
              ->cascadeOnDelete();

        $table->foreignId('user_id')
              ->constrained('users')
              ->cascadeOnDelete();

        // Content
        $table->text('body');
        $table->integer('votes_count')->default(0);

        // Timestamps
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
