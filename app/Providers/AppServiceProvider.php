<?php

namespace App\Providers;

use App\Repositories\DBHeroRepository;
use App\Repositories\HeroRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            HeroRepositoryInterface::class,
            DBHeroRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
