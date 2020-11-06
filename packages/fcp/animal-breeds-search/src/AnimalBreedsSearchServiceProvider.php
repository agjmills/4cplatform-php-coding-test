<?php

namespace Fcp\AnimalBreedsSearch;

use Fcp\AnimalBreedsSearch\Commands\SearchBreeds;
use Illuminate\Support\ServiceProvider;

/**
 * Class AnimalBreedsSearchServiceProvider
 *
 * @package Fcp\AnimalBreedsSearch
 */
class AnimalBreedsSearchServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/animal-breeds-search.php', 'animal-breeds-search');

        $this->app->bind('animalbreeds', function () {
            return new AnimalBreeds;
        });
    }

    protected function bootForConsole(): void
    {
        $this->commands([SearchBreeds::class]);
    }
}
