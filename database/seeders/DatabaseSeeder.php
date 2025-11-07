<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    
        User::factory(3)->create()->each(function ($user) {
            Question::factory(rand(1, 5))->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
