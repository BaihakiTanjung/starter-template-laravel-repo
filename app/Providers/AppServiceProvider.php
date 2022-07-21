<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryImplement;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\AuthRepositoryImplement;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserRepository::class,
            UserRepositoryImplement::class
        );

        $this->app->bind(
            AuthRepository::class,
            AuthRepositoryImplement::class
        );
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
