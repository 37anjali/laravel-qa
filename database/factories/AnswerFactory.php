<?php

namespace Database\Factories;

use App\Models\Answer;
use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    protected $model = Answer::class;

    public function definition()
    {
        return [
            'question_id' => Question::inRandomOrder()->value('id') ?? Question::factory(),
            'user_id'     => User::inRandomOrder()->value('id') ?? User::factory(),
            'body'        => $this->faker->paragraphs(rand(2, 6), true),
            // 'votes_count' => rand(0, 10),
        ];
    }
}
