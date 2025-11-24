<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(5)->create()->each(function ($user) {

            // Create 2–5 questions per user
            $questions = Question::factory(rand(2, 5))->create([
                'user_id' => $user->id
            ]);

            // Create 1–5 answers for each question
            $questions->each(function ($q) {
                Answer::factory(rand(1, 5))->create([
                    'question_id' => $q->id,
                    'user_id'     => User::inRandomOrder()->value('id'), // any random user
                ]);
            });

        });
    }
}
