<?php

/*
|--------------------------------------------------------------------------
| Rechtstexte: portal-spezifischer Teil
|--------------------------------------------------------------------------
|
| Hier stehen NUR die Angaben, die sich von Portal zu Portal unterscheiden.
|
| Firmendaten (Name, Anschrift, HRB, USt-ID, Kontakt), Aufsichtsbehoerde und
| der Stand der Texte kommen aus dem Paket immowert/legal und lassen sich hier
| bewusst nicht ueberschreiben - der ServiceProvider setzt sie nach dem Merge
| zurueck. Genau daran ist die alte Loesung gescheitert: jede Seite pflegte
| ihre eigene Anschrift, und nach ein paar Jahren stimmte keine mehr.
|
| Adresse oder Firmierung geaendert? Dann im Paket, dort taggen, hier
| "composer update immowert/legal".
|
*/

return [

    /*
    | Wie dieses Portal heisst und wovon es sich abgrenzt.
    |
    | "disclaimer" landet im Impressum, "datenschutz_intro" als erster Absatz
    | der Datenschutzerklaerung. Beide gehoeren gesetzt - der Behoerdenhinweis
    | ist der einzige Teil des Impressums, der pro Portal wirklich anders ist.
    */
    'site' => [
        'name'              => env('LEGAL_SITE_NAME', config('app.name')),
        'url'               => env('LEGAL_SITE_URL', config('app.url')),
        'disclaimer'        => null,
        'datenschutz_intro' => null,
    ],

    /*
    | Was auf DIESEM Portal tatsaechlich passiert.
    |
    | Die Datenschutzerklaerung rendert nur die aktivierten Bloecke und
    | nummeriert die Abschnitte selbst durch. Wer einen Dienst ein- oder
    | ausbaut, muss das Flag mitziehen - sonst beschreibt die Erklaerung
    | etwas, das es nicht gibt (oder verschweigt etwas, das es gibt).
    */
    'services' => [
        'server_logs'     => true,
        'cookies'         => true,
        'umami'           => false,   // selbst gehostete Statistik (umami.10-x.eu)
        'google_ads'      => false,   // Conversion-Tracking
        'google_fonts'    => false,   // false = Schriften liegen im eigenen Bundle
        'google_maps'     => false,   // Karten-iframe
        'kontaktformular' => false,
        'bestellformular' => false,   // Antragsstrecke ueber client.10-x.eu
        'vertragsdaten'   => false,
        'paypal'          => false,
        'registrierung'   => false,
        'kommentare'      => false,
    ],

    /*
    | Hostinganbieter dieses Portals: allinkl | hetzner | hostinger
    */
    'hosting' => [
        'provider' => env('LEGAL_HOSTING', 'allinkl'),
    ],

    /*
    | Pfade der Rechtsseiten. Historisch gibt es /agb und /agbs.
    */
    'routes' => [
        'impressum'   => ['path' => 'impressum',   'name' => 'impressum',   'enabled' => true],
        'datenschutz' => ['path' => 'datenschutz', 'name' => 'datenschutz', 'enabled' => true],
        'agb'         => ['path' => 'agb',         'name' => 'agb',         'enabled' => true],
    ],

];
