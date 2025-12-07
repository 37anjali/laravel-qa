<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VotableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete old votes for questions
        DB::table('votables')
            ->where('votable_type', Question::class)
            ->delete();

        $users = User::all();
        $votes = [-1, 1];

        foreach (Question::all() as $question) {
            $usersToVote = $users->shuffle()->take(rand(1, $users->count()));

            foreach ($usersToVote as $user) {
                // This method must exist in User model
                $user->voteQuestion(
                    $question,
                    $votes[array_rand($votes)]
                );
            }
        }
    }
}
