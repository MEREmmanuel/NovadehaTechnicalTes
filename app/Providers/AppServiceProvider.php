<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Mockery\Generator\StringManipulation\Pass\Pass;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Services\AuthServiceInterface::class,
            \App\Services\AuthService::class
        );
        $this->app->bind(
            \App\Repositories\UserRepositoryInterface::class,
            \App\Repositories\UserRepository::class
        );
        $this->app->bind(
            \App\Services\CompanyServiceInterface::class,
            \App\Services\CompanyService::class
        );
        $this->app->bind(
            \App\Repositories\CompanyRepositoryInterface::class,
            \App\Repositories\CompanyRepository::class
        );
        $this->app->bind(
            \App\Services\NoteServiceInterface::class,
            \App\Services\NoteService::class
        );
        $this->app->bind(
            \App\Repositories\NoteRepositoryInterface::class,
            \App\Repositories\NoteRepository::class
        );
        $this->app->bind(
            \App\Services\ContactServiceInterface::class,
            \App\Services\ContactService::class
        );
        $this->app->bind(
            \App\Repositories\ContactRepositoryInterface::class,
            \App\Repositories\ContactRepository::class
        );
        $this->app->bind(
            \App\Services\StatusServiceInterface::class,
            \App\Services\StatusService::class
        );
        $this->app->bind(
            \App\Repositories\StatusRepositoryInterface::class,
            \App\Repositories\StatusRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::loadKeysFrom(storage_path());
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
