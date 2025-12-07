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
        Schema::create('votables', function (Blueprint $table) {
            $table->id(); // optional, but recommended in Laravel 12

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->unsignedBigInteger('votable_id');
            $table->string('votable_type');

            $table->tinyInteger('vote')
                ->comment('-1 : down vote, 1 : up vote');

            $table->timestamps();

            // FIXED spelling error: votble_id → votable_id
            $table->unique(['user_id', 'votable_id', 'votable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votables');
    }
};
