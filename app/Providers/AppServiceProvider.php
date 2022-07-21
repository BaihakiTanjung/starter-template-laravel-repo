<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryImplement;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\AuthRepositoryImplement;
use App\Repositories\Referral\ReferralRepository;
use App\Repositories\Referral\ReferralRepositoryImplement;

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

        $this->app->bind(
            ReferralRepository::class,
            ReferralRepositoryImplement::class
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
