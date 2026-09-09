# immowert/legal

Zentrale Rechtstexte (Impressum, Datenschutzerklärung, AGB) für alle Portale der
ImmoWert Experts GmbH.

## Warum

Vor diesem Paket lagen Impressum, Datenschutz und AGB als Kopien in jedem Portal.
Ergebnis nach ein paar Jahren: vier Firmennamen, zwei Anschriften, zwei Faxnummern,
kaputte `mailto:`-Adressen — teils sogar zwei verschiedene Anschriften **innerhalb
derselben Datei**. Wer die Anschrift ändern wollte, musste ~20 Repos anfassen.

Jetzt gilt: **Der Rechtstext liegt genau einmal — hier.** Ein Portal enthält davon
nur noch drei Wrapper-Views mit dem eigenen Layout.

## Installation in einem Portal

```bash
composer config repositories.immowert-legal vcs https://github.com/ImmoWert-Experts-GmbH/legal.git
composer require immowert/legal:^1.0
php artisan vendor:publish --tag=immowert-legal-views
```

`routes/web.php`:

```php
use ImmoWert\Legal\Facades\Legal;

Legal::routes();   // registriert /impressum, /datenschutz, /agb
```

Footer — ersetzt die bisherigen Links auf fremde Domains:

```blade
<x-legal::footer-links />
```

Anschließend `resources/views/legal/{impressum,datenschutz,agb}.blade.php` an das
Layout des Portals anpassen. Diese drei Dateien sind das Einzige, was pro Portal
gepflegt wird — sie enthalten keinen Rechtstext.

## Was pro Portal konfiguriert wird

`php artisan vendor:publish --tag=immowert-legal-config` legt
`config/immowert-legal.php` an. Dort gehören **nur** diese Blöcke hin:

| Block           | Zweck                                                                 |
|-----------------|-----------------------------------------------------------------------|
| `site`          | Name, URL, Behörden-Abgrenzungshinweis, Intro der Datenschutzerklärung |
| `services`      | Welche Verarbeitungen es auf **diesem** Portal wirklich gibt           |
| `hosting`       | Hostinganbieter dieses Portals                                        |
| `routes`        | Abweichende Pfade (historisch gibt es `/agb` und `/agbs`)              |

**`company` gehört nicht dazu.** Firmendaten kommen immer aus dem Paket. Wer sie
lokal überschreibt, baut genau die Drift wieder auf, die das Paket beseitigt.

### `services` bestimmt den Text

Die Datenschutzerklärung rendert ausschließlich die aktivierten Blöcke und nummeriert
die Abschnitte automatisch durch. Steht `google_fonts` auf `false`, taucht Google im
Text nicht auf — statt eines Google-Absatzes erscheint der Hinweis, dass Schriften vom
eigenen Server geladen werden. Damit kann keine Erklärung mehr Dienste behaupten, die
es auf der Seite gar nicht gibt.

## Änderung ausrollen

1. Text oder Firmendaten hier ändern.
2. `version` und `stand` in `config/immowert-legal.php` hochziehen, taggen, pushen.
3. In den Portalen `composer update immowert/legal` und deployen.

Unter jedem Rechtstext steht die ausgelieferte Fassung. Ein Portal, das beim Deploy
vergessen wurde, ist damit von außen erkennbar — ohne in ein Repo zu schauen.

## Drift-Kontrolle

```bash
php artisan legal:check
```

Findet Rechtsangaben, die im Portal wieder von Hand dupliziert wurden und von den
zentralen Daten abweichen (alte Anschrift, alte Firmierung, alte Faxnummer, `§ 5 TMG`,
Links auf fremde Rechtstexte). Exit-Code 1 bei Treffern — gehört in `deploy.sh`:

```sh
php artisan legal:check || exit 1
```

## Komponenten

| Komponente                    | Inhalt                                          |
|-------------------------------|-------------------------------------------------|
| `<x-legal::impressum />`      | vollständiges Impressum                         |
| `<x-legal::datenschutz />`    | Datenschutzerklärung, nach `services` gefiltert |
| `<x-legal::agb />`            | AGB                                             |
| `<x-legal::company-block />`  | nur der Firmenblock (Anschrift)                 |
| `<x-legal::contact-block />`  | nur E-Mail/Telefon/Fax                          |
| `<x-legal::footer-links />`   | Footer-Links auf die eigenen Rechtsseiten       |
| `<x-legal::stand />`          | Fassung und Stand                               |

Für JSON-LD, Rechnungen und E-Mail-Footer:

```php
Legal::company();      // Array mit allen Firmendaten
Legal::addressLine();  // "ImmoWert Experts GmbH, Clara-Zetkin-Str. 10A, 01796 Pirna"
```
