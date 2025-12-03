<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
{
    public function run(): void
    {
        // Clear favorites table safely
        DB::table('favorites')->truncate();

        $users = User::pluck('id')->all();
        $numberOfUsers = count($users);

        foreach (Question::all() as $question) {
            // Pick random users to favorite this question
            $randomUsers = collect($users)
                ->shuffle()
                ->take(rand(0, $numberOfUsers))
                ->all();

            // Attach favorites without duplicates
            $question->favorites()->syncWithoutDetaching($randomUsers);
        }
    }
}
