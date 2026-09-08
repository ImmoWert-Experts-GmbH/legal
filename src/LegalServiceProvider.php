<?php

namespace ImmoWert\Legal;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LegalServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/immowert-legal.php', 'immowert-legal');

        $this->app->singleton(Legal::class, fn ($app) => new Legal($app['config']));
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'legal');

        // <x-legal::impressum />, <x-legal::ds.umami /> usw.
        Blade::anonymousComponentPath(__DIR__.'/../resources/views/components', 'legal');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/immowert-legal.php' => config_path('immowert-legal.php'),
            ], 'immowert-legal-config');

            // Duenne Wrapper-Views: bringen den Paketinhalt ins Layout des Portals.
            // Nur die werden pro Portal angefasst, der Rechtstext nie.
            $this->publishes([
                __DIR__.'/../resources/views/stubs' => resource_path('views/legal'),
            ], 'immowert-legal-views');

            $this->commands([
                Console\CheckCommand::class,
            ]);
        }
    }
}
