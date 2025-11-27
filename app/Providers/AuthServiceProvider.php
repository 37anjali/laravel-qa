<?php

namespace App\Providers;

use App\Models\Question;
use App\Models\Answer;
use App\Policies\QuestionPolicy;
use App\Policies\AnswerPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model-to-policy mappings.
     */
    protected $policies = [
        Question::class => QuestionPolicy::class,
        Answer::class   => AnswerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
