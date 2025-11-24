<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(3)->create()->each(function ($user) {

            // Create questions for each user
            $questions = Question::factory(rand(1, 5))->create([
                'user_id' => $user->id
            ]);

            // Create answers for each question
            $questions->each(function ($q) {
                Answer::factory(rand(1, 5))->create([
                    'question_id' => $q->id,
                    'user_id' => $q->user_id,   // or random user
                ]);
            });

        });
    }
}
