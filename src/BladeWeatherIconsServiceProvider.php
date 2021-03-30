<?php

declare(strict_types=1);

namespace Codeat3\BladeWeatherIcons;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;

final class BladeWeatherIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->callAfterResolving(Factory::class, function (Factory $factory) {
            $factory->add('weather-icons', [
                'path' => __DIR__.'/../resources/svg',
                'prefix' => 'wi',
            ]);
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-wi'),
            ], 'blade-wi');
        }
    }
}
