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
        Schema::create('questions', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Ensure the same storage engine as users table

            $table->id(); // Creates BIGINT UNSIGNED
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body');
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('answers')->default(0);
            $table->integer('votes')->default(0);
            $table->unsignedBigInteger('best_answer_id')->nullable();

            // ✅ Fix: Use unsignedBigInteger to match users.id
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
