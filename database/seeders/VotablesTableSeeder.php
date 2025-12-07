<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;

class VotablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing votes
        DB::table('votables')->truncate();

        $users = User::all();
        $numberOfUsers = $users->count();
        $votes = [-1, 1];

        // Vote on Questions
        foreach (Question::all() as $question) {
            foreach ($users->random(rand(1, $numberOfUsers)) as $user) {
                $user->voteQuestion($question, $votes[array_rand($votes)]);
            }
        }

        // Vote on Answers
        foreach (Answer::all() as $answer) {
            foreach ($users->random(rand(1, $numberOfUsers)) as $user) {
                $user->voteAnswer($answer, $votes[array_rand($votes)]);
            }
        }
    }
}
