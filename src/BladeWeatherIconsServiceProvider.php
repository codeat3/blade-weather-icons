<?php

declare(strict_types=1);

namespace Codeat3\BladeWeatherIcons;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;

final class BladeWeatherIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-weather-icons', []);

            $factory->add('weather-icons', array_merge(['path' => __DIR__.'/../resources/svg'], $config));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/blade-weather-icons.php', 'blade-weather-icons');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-weather-icons'),
            ], 'blade-wi'); // TODO: rename this alias to `blade-weather-icons` in next major release

            $this->publishes([
                __DIR__.'/../config/blade-weather-icons.php' => $this->app->configPath('blade-weather-icons.php'),
            ], 'blade-weather-icons-config');
        }
    }
}
