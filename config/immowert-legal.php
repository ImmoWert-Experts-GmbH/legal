<?php

/*
|--------------------------------------------------------------------------
| Zentrale Rechtstexte der ImmoWert Experts GmbH
|--------------------------------------------------------------------------
|
| Diese Datei ist die *einzige* Stelle, an der Firmendaten gepflegt werden.
| Die Bloecke unter "company" gelten fuer alle Portale und werden bewusst
| NICHT pro Seite ueberschrieben - eine Aenderung hier (z. B. neue Anschrift)
| wird durch "composer update immowert/legal" auf allen Portalen wirksam.
|
| Pro Portal gehoeren nur die Bloecke "site" und "services" in die lokale
| config/immowert-legal.php bzw. in die .env. Alles andere bleibt zentral.
|
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Firmendaten (zentral - nicht pro Portal aendern)
    |--------------------------------------------------------------------------
    */
    'company' => [
        'name'           => 'ImmoWert Experts GmbH',
        'prefix'         => 'Ingenieurbuero',
        'street'         => 'Clara-Zetkin-Str. 10A',
        'postal_code'    => '01796',
        'city'           => 'Pirna',
        'country'        => 'Deutschland',
        'email'          => 'hi@iw24.eu',
        'phone'          => null,
        'fax'            => '03501 790 460 1',
        'register'       => 'HRB 36565',
        'register_court' => 'Amtsgericht Dresden',
        'vat_id'         => 'DE311706045',
        'represented_by' => ['Stephanie Pilz', 'Dennis Pilz'],
        'dpo'            => 'Der Datenschutzbeauftragte im Unternehmen ist die Geschaeftsfuehrung.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Aufsichtsbehoerde (zentral)
    |--------------------------------------------------------------------------
    */
    'authority' => [
        'name' => 'Saechsischer Datenschutzbeauftragter',
        'url'  => 'https://www.saechsdsb.de/',
    ],

    /*
    |--------------------------------------------------------------------------
    | Portal-spezifisch (gehoert in die lokale config des jeweiligen Portals)
    |--------------------------------------------------------------------------
    |
    | "disclaimer" ist der Behoerden-Abgrenzungshinweis. Er MUSS pro Portal
    | gesetzt werden, weil er beschreibt, wovon sich das Portal abgrenzt
    | (Grundbuchamt / Katasteramt / Gutachterausschuss / ...).
    |
    */
    'site' => [
        'name'       => env('LEGAL_SITE_NAME'),
        'url'        => env('LEGAL_SITE_URL'),
        'disclaimer' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Verarbeitungen, die auf DIESEM Portal tatsaechlich stattfinden
    |--------------------------------------------------------------------------
    |
    | Die Datenschutzerklaerung rendert ausschliesslich die hier aktivierten
    | Bloecke. Was hier auf false steht, taucht im Text nicht auf - damit
    | steht in keiner Erklaerung mehr ein Dienst, den es auf der Seite gar
    | nicht gibt (Altlast der uebernommenen Textbausteine).
    |
    */
    'services' => [
        'server_logs'      => true,
        'cookies'          => true,
        'umami'            => false,   // selbst gehostete Statistik (umami.10-x.eu) - einziges Analysewerkzeug
        'google_ads'       => false,
        'google_fonts'     => false,   // false = Schriften liegen im eigenen Bundle
        'google_maps'      => false,
        'kontaktformular'  => false,
        'bestellformular'  => false,   // Antragsstrecke ueber client.10-x.eu
        'vertragsdaten'    => false,
        'paypal'           => false,
        'registrierung'    => false,
        'kommentare'       => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Hosting
    |--------------------------------------------------------------------------
    */
    'hosting' => [
        'provider' => env('LEGAL_HOSTING', 'allinkl'),
    ],

    'hosting_providers' => [
        'allinkl' => [
            'name'     => 'ALL-INKL.COM - Neue Medien Muennich, Inhaber Rene Muennich',
            'address'  => 'Hauptstrasse 68, 02742 Friedersdorf',
            'location' => 'Rechenzentrum in Deutschland',
        ],
        'hetzner' => [
            'name'     => 'Hetzner Online GmbH',
            'address'  => 'Industriestr. 25, 91710 Gunzenhausen',
            'location' => 'Rechenzentrum in Deutschland',
        ],
        'hostinger' => [
            'name'     => 'Hostinger International Ltd.',
            'address'  => '61 Lordou Vironos Street, 6023 Larnaca, Zypern',
            'location' => 'Serverstandort Deutschland',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Routen, die Legal::routes() registriert
    |--------------------------------------------------------------------------
    |
    | Pfade sind pro Portal anpassbar (historisch gibt es /agb und /agbs).
    | "enabled" schaltet eine Seite ab, wenn ein Portal sie nicht braucht.
    |
    */
    'routes' => [
        'impressum'   => ['path' => 'impressum',   'name' => 'impressum',   'enabled' => true],
        'datenschutz' => ['path' => 'datenschutz', 'name' => 'datenschutz', 'enabled' => true],
        'agb'         => ['path' => 'agb',         'name' => 'agb',         'enabled' => true],
    ],

    /*
    |--------------------------------------------------------------------------
    | Stand der Texte
    |--------------------------------------------------------------------------
    |
    | Wird unter jedem Rechtstext ausgegeben. So ist auf jedem Portal von
    | aussen sichtbar, welche Paketversion dort ausgeliefert wird - eine Seite,
    | die beim Deploy vergessen wurde, faellt sofort auf.
    |
    */
    'version' => '1.0.0',
    'stand'   => '2026-09-08',

];
