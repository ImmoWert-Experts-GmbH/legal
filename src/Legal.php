<?php

namespace ImmoWert\Legal;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Facades\Route;

class Legal
{
    public function __construct(private Repository $config)
    {
    }

    /**
     * Registriert /impressum, /datenschutz und /agb im Portal.
     *
     * Die Routen zeigen auf die Wrapper-Views des Portals (resources/views/legal/*),
     * damit jedes Portal sein eigenes Layout behaelt. Fehlt ein Wrapper, faellt die
     * Route auf die Paketansicht zurueck - die Seite ist damit nie tot, auch wenn
     * ein Portal die Views noch nicht publiziert hat.
     *
     * Eine Route mit "text" (z. B. 'widerruf_digital') entsteht nur, wenn dieser
     * Text zentral freigegeben ist (released()). Bis dahin fehlt die Route, und
     * das Portal sieht ueber Route::has(), dass der Text noch aussteht.
     */
    public function routes(): void
    {
        foreach ($this->config->get('immowert-legal.routes', []) as $page => $route) {
            if (! ($route['enabled'] ?? true)) {
                continue;
            }

            if (isset($route['text']) && ! $this->released($route['text'])) {
                continue;
            }

            // Statische Closure ohne $this: `route:cache` serialisiert sie, und
            // Laravel 13 entpackt gecachte Routen nur mit einer Whitelist
            // erlaubter Klassen. Eine Instanz dieser Klasse kaeme dort als
            // __PHP_Incomplete_Class an - /impressum lieferte dann HTTP 500.
            Route::get($route['path'], static fn () => view(app(self::class)->viewFor($page)))
                ->name($route['name']);
        }
    }

    public function viewFor(string $page): string
    {
        return view()->exists("legal.{$page}") ? "legal.{$page}" : "legal::fallback.{$page}";
    }

    /** @return array<string, mixed> */
    public function company(): array
    {
        return (array) $this->config->get('immowert-legal.company', []);
    }

    /** Firma mit Anschrift in einer Zeile - fuer JSON-LD, Rechnungen, E-Mail-Footer. */
    public function addressLine(): string
    {
        $c = $this->company();

        return sprintf(
            '%s, %s, %s %s',
            $c['name'] ?? '',
            $c['street'] ?? '',
            $c['postal_code'] ?? '',
            $c['city'] ?? ''
        );
    }

    /** Ist der Text (Schluessel aus 'texts') inhaltlich freigegeben? */
    public function released(string $text): bool
    {
        return $this->config->get("immowert-legal.texts.{$text}") === true;
    }

    /** Freigegebener Checkbox-Wortlaut oder null, solange er aussteht. */
    public function consent(string $key): ?string
    {
        $text = $this->config->get("immowert-legal.consents.{$key}");

        return is_string($text) && trim($text) !== '' ? $text : null;
    }

    public function uses(string $service): bool
    {
        return (bool) $this->config->get("immowert-legal.services.{$service}", false);
    }

    public function siteName(): string
    {
        return (string) ($this->config->get('immowert-legal.site.name')
            ?: $this->config->get('app.name'));
    }
}
