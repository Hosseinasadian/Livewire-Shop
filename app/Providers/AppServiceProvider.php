<?php

namespace App\Providers;

use App\Classes\ElasticSearch;
use App\Interfaces\TemplateRepositoryInterface;
use App\Repositories\TemplateRepository;
use Illuminate\Support\ServiceProvider;
use Laravel\Scout\EngineManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TemplateRepositoryInterface::class, TemplateRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        resolve(EngineManager::class)->extend('elastic_search', function () {
            return new ElasticSearch;
        });
    }
}
