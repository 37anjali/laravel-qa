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
        Schema::table('questions', function (Blueprint $table) {
            // Add foreign key using Laravel 12 syntax
            $table->foreign('best_answer_id')
                  ->references('id')
                  ->on('answers')
                  ->nullOnDelete(); // same as onDelete('set null')
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            // Laravel automatically creates foreign key name: questions_best_answer_id_foreign
            $table->dropForeign('questions_best_answer_id_foreign');
        });
    }
};
