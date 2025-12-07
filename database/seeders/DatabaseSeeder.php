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
       
        $this->call([
            UserQuestionAnswersTableSeeder::class,
            FavoritesTableSeeder::class,
            VotablesTableSeeder::class,
        ]);
    }
}
