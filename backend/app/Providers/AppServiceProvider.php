<?php

namespace App\Providers;

use App\Contracts\IAnswerService;
use App\Contracts\IAuthService;
use App\Contracts\IQuestionnaireService;
use App\Contracts\IQuestionService;
use App\Contracts\IUserService;
use App\Services\AnswerService;
use App\Services\AuthService;
use App\Services\QuestionnaireService;
use App\Services\QuestionService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IAuthService::class, AuthService::class);
        $this->app->bind(IQuestionnaireService::class, QuestionnaireService::class);
        $this->app->bind(IQuestionService::class, QuestionService::class);
        $this->app->bind(IAnswerService::class, AnswerService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
