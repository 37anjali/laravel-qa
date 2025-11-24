<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Question;
use App\Models\User;

/**
 * @extends Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        $title = rtrim($this->faker->sentence(rand(5, 10)), '.');

        return [
            'title'   => $title,
            'slug'    => Str::slug($title),
            'body'    => $this->faker->paragraphs(rand(3, 7), true),
            'views'   => rand(0, 10),
            'answers_count' => rand(0, 10),
            'votes'   => rand(-3, 10),
            'user_id' => User::factory(),
        ];
    }
}
