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

    /**
     * Schluessel, die IMMER aus dem Paket kommen.
     *
     * mergeConfigFrom() merged nur flach: haette ein Portal einen eigenen
     * "company"-Block in seiner config/immowert-legal.php, wuerde der den des
     * Pakets komplett ersetzen - und eine zentrale Adressaenderung kaeme dort
     * nie an. Genau die Drift soll das Paket beseitigen, also werden diese
     * Bloecke nach dem Merge zurueckgesetzt.
     */
    private const CENTRAL = ['company', 'authority', 'hosting_providers', 'version', 'stand'];

    public function boot(): void
    {
        $central = require __DIR__.'/../config/immowert-legal.php';

        foreach (self::CENTRAL as $key) {
            $this->app['config']->set("immowert-legal.{$key}", $central[$key]);
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'legal');

        // <x-legal::impressum />, <x-legal::ds.umami /> usw.
        Blade::anonymousComponentPath(__DIR__.'/../resources/views/components', 'legal');

        if ($this->app->runningInConsole()) {
            // Publiziert wird nur der portal-spezifische Teil. Firmendaten
            // stehen bewusst nicht darin - sie kommen aus dem Paket.
            $this->publishes([
                __DIR__.'/../config/portal.stub.php' => config_path('immowert-legal.php'),
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
