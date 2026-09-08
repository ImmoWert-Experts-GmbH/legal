<?php

namespace ImmoWert\Legal\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ImmoWert\Legal\Legal;

/**
 * Findet Rechtsangaben, die im Portal haendisch dupliziert wurden und von den
 * zentralen Firmendaten abweichen - also genau die Drift, wegen der es dieses
 * Paket gibt. Laeuft im Deploy und bricht mit Exit-Code 1 ab, wenn ein Portal
 * wieder eigene Firmendaten einschmuggelt.
 */
class CheckCommand extends Command
{
    protected $signature = 'legal:check {--fail-on-warning : Exit-Code 1 auch bei blossen Warnungen}';

    protected $description = 'Prueft das Portal auf veraltete oder doppelt gepflegte Rechtsangaben';

    /**
     * Muster, die auf einer Seite nichts mehr zu suchen haben.
     *
     * @var array<string, string>
     */
    private const STALE = [
        'Rottwerndorfer'                                  => 'Alte Anschrift - aktuell ist Clara-Zetkin-Str. 10A.',
        'Verlagsgesellschaft mbH'                         => 'Alte Firmierung - aktuell ist ImmoWert Experts GmbH.',
        'ImmoWert Experts SIV'                            => 'Falsche Firmierung - aktuell ist ImmoWert Experts GmbH.',
        'ImmoWert Experts mbH'                            => 'Falsche Firmierung - aktuell ist ImmoWert Experts GmbH.',
        '599 344 8'                                       => 'Alte Faxnummer - aktuell ist 03501 790 460 1.',
        'iw24.eu.de'                                      => 'Tippfehler in der E-Mail-Adresse - richtig ist hi@iw24.eu.',
        '§ 5 TMG'                                         => 'TMG ist seit 05/2024 durch das DDG abgeloest.',
        'at ] Grundbuch'                                  => 'Unverlinkte Platzhalter-Adresse aus altem Textbaustein.',
        'grundbuch24.de/impressum'                        => 'Rechtstext wird auf eine fremde Domain verlinkt statt lokal ausgeliefert.',
    ];

    public function handle(Legal $legal): int
    {
        $paths = array_filter([
            resource_path('views'),
            resource_path('js'),
            app_path(),
            config_path(),
        ], fn ($p) => File::isDirectory($p));

        $findings = [];

        foreach ($paths as $path) {
            foreach (File::allFiles($path) as $file) {
                if (! in_array($file->getExtension(), ['php', 'blade', 'tsx', 'jsx', 'vue', 'html'], true)) {
                    continue;
                }

                $lines = file($file->getPathname(), FILE_IGNORE_NEW_LINES);

                foreach ($lines as $no => $line) {
                    foreach (self::STALE as $needle => $why) {
                        if (str_contains($line, $needle)) {
                            $findings[] = [
                                ltrim(str_replace(base_path(), '', $file->getPathname()), '\/').':'.($no + 1),
                                $needle,
                                $why,
                            ];
                        }
                    }
                }
            }
        }

        $this->line('Zentrale Firmendaten: <info>'.$legal->addressLine().'</info>');
        $this->line('Paketstand:           <info>'.config('immowert-legal.version').' ('.config('immowert-legal.stand').')</info>');
        $this->newLine();

        if ($findings === []) {
            $this->info('Keine abweichenden Rechtsangaben gefunden.');

            return self::SUCCESS;
        }

        $this->error(count($findings).' abweichende Rechtsangabe(n) gefunden:');
        $this->table(['Fundstelle', 'Muster', 'Grund'], $findings);

        return self::FAILURE;
    }
}
