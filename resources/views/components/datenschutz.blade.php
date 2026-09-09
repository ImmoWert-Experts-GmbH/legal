{{-- Datenschutzerklaerung - zentral gepflegt in immowert/legal.

     Gerendert werden nur die Abschnitte, die in
     config('immowert-legal.services') fuer DIESES Portal aktiviert sind.
     Damit steht in keiner Erklaerung mehr ein Dienst, den es auf der Seite
     gar nicht gibt. Die Nummerierung zaehlt automatisch mit. --}}
@php
    $c       = (array) config('immowert-legal.company');
    $site    = (array) config('immowert-legal.site');
    $svc     = (array) config('immowert-legal.services');
    $auth    = (array) config('immowert-legal.authority');
    $hostKey = config('immowert-legal.hosting.provider');
    $host    = (array) data_get(config('immowert-legal.hosting_providers'), $hostKey, []);
    $n       = 0;
    $num     = function () use (&$n) { return ++$n . '. '; };
@endphp

<h2>{{ $num() }}Datenschutz auf einen Blick</h2>
<p>
    @if (!empty($site['datenschutz_intro']))
        {{ $site['datenschutz_intro'] }}
    @else
        Beim bloßen Lesen dieser Website verarbeiten wir nur die technisch notwendigen Verbindungsdaten.
        Personenbezogene Daten geben Sie erst ein, wenn Sie uns kontaktieren oder eine Leistung bestellen.
    @endif
    @unless ($svc['google_ads'] ?? false)
        Wir setzen keine Werbe-Cookies und binden keine Werbenetzwerke ein.
    @endunless
</p>

<h2>{{ $num() }}Verantwortlicher</h2>
<p>
    {{ $c['name'] }}<br>
    {{ $c['street'] }}, {{ $c['postal_code'] }} {{ $c['city'] }}<br>
    Vertreten durch: {{ implode(', ', (array) ($c['represented_by'] ?? [])) }}<br>
    E-Mail: <a href="mailto:{{ $c['email'] }}">{{ $c['email'] }}</a>
    @if (!empty($c['fax']))<br>Telefax: {{ $c['fax'] }}@endif
</p>
<p>{{ $c['dpo'] }} Sie erreichen ihn unter der oben genannten Anschrift und E-Mail-Adresse.</p>

<h2>{{ $num() }}Hosting und Server-Protokolle</h2>
@if ($host)
    <p>
        Diese Website wird bei {{ $host['name'] }}, {{ $host['address'] }}, gehostet
        ({{ $host['location'] }}). Mit dem Anbieter besteht ein Vertrag über Auftragsverarbeitung
        nach Art. 28 DSGVO.
    </p>
@endif
@if ($svc['server_logs'] ?? true)
    <p>
        Bei jedem Aufruf speichert der Webserver automatisch in Protokolldateien: IP-Adresse, Datum und
        Uhrzeit, aufgerufene Seite, übertragene Datenmenge, Referrer-URL sowie Browser und Betriebssystem.
        Diese Daten dienen dem sicheren und stabilen Betrieb und werden nicht mit anderen Datenquellen
        zusammengeführt. Rechtsgrundlage ist Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse an einem
        sicheren Betrieb). Die Protokolle werden nach spätestens 14 Tagen gelöscht, sofern sie nicht zur
        Aufklärung eines Sicherheitsvorfalls länger benötigt werden.
    </p>
@endif

@if ($svc['cookies'] ?? true)
    <h2>{{ $num() }}Cookies</h2>
    <p>
        Diese Website setzt keine Cookies zu Werbe-, Analyse- oder Trackingzwecken. Ein technisch
        notwendiges Sitzungs-Cookie wird nur gesetzt, wenn Sie ein Formular nutzen; es schützt vor
        missbräuchlichen Absendungen (CSRF-Schutz) und wird beim Schließen des Browsers gelöscht
        (§ 25 Abs. 2 Nr. 2 TDDDG, Art. 6 Abs. 1 lit. f DSGVO).
        @if ($svc['bestellformular'] ?? false)
            Das eingebettete Bestellformular kann eigene technisch notwendige Cookies setzen.
        @endif
    </p>
@endif

@if ($svc['bestellformular'] ?? false)
    <h2>{{ $num() }}Bestellung über das Antragsformular</h2>
    <x-legal::ds.bestellformular />
@endif

@if ($svc['kontaktformular'] ?? false)
    <h2>{{ $num() }}Kontaktformular</h2>
    <p>
        Wenn Sie uns über das Kontaktformular Anfragen zukommen lassen, werden Ihre Angaben aus dem
        Formular inklusive der von Ihnen dort angegebenen Kontaktdaten zwecks Bearbeitung der Anfrage und
        für den Fall von Anschlussfragen bei uns gespeichert. Diese Daten geben wir nicht ohne Ihre
        Einwilligung weiter. Rechtsgrundlage ist Art. 6 Abs. 1 lit. b DSGVO bei Vertragsbezug, sonst
        Art. 6 Abs. 1 lit. f DSGVO. Die Daten werden gelöscht, sobald die Anfrage erledigt ist und keine
        Aufbewahrungspflichten entgegenstehen.
    </p>
@endif

<h2>{{ $num() }}Kontakt per E-Mail</h2>
<p>
    Wenn Sie uns per E-Mail schreiben, verarbeiten wir Ihre Angaben zur Bearbeitung der Anfrage
    (Art. 6 Abs. 1 lit. b DSGVO bei Vertragsbezug, sonst Art. 6 Abs. 1 lit. f DSGVO). Die Nachrichten
    werden gelöscht, sobald die Anfrage erledigt ist und keine Aufbewahrungspflichten entgegenstehen.
</p>

@if ($svc['vertragsdaten'] ?? false)
    <h2>{{ $num() }}Verarbeiten von Kunden- und Vertragsdaten</h2>
    <p>
        Wir erheben, verarbeiten und nutzen personenbezogene Daten nur, soweit sie für die Begründung,
        inhaltliche Ausgestaltung oder Änderung des Rechtsverhältnisses erforderlich sind
        (Art. 6 Abs. 1 lit. b DSGVO). Kunden- und Vertragsdaten bewahren wir für die Dauer der
        gesetzlichen Aufbewahrungsfristen auf (sechs beziehungsweise zehn Jahre nach § 257 HGB und
        § 147 AO) und löschen sie danach.
    </p>
@endif

@if (($svc['paypal'] ?? false) || ($svc['stripe'] ?? false))
    <h2>{{ $num() }}Zahlungsdienstleister</h2>
    @if ($svc['paypal'] ?? false)
        <x-legal::ds.paypal />
    @endif
    @if ($svc['stripe'] ?? false)
        <x-legal::ds.stripe />
    @endif
@endif

@if (($svc['umami'] ?? false) || ($svc['google_ads'] ?? false))
    <h2>{{ $num() }}Reichweitenmessung und Werbung</h2>
    @if ($svc['umami'] ?? false)
        <x-legal::ds.umami />
    @endif
    @if ($svc['google_ads'] ?? false)
        <x-legal::ds.google-ads />
    @endif
@else
    <h2>{{ $num() }}Keine Reichweitenmessung</h2>
    <p>Wir setzen derzeit kein Analysewerkzeug ein und erstellen keine Nutzungsprofile.</p>
@endif

@if (($svc['google_fonts'] ?? false) || ($svc['google_maps'] ?? false) || ($svc['openstreetmap'] ?? false))
    <h2>{{ $num() }}Eingebundene Inhalte Dritter</h2>
    @if ($svc['google_fonts'] ?? false)
        <x-legal::ds.google-fonts />
    @endif
    @if ($svc['google_maps'] ?? false)
        <x-legal::ds.google-maps />
    @endif
    @if ($svc['openstreetmap'] ?? false)
        <x-legal::ds.openstreetmap />
    @endif
@else
    <h2>{{ $num() }}Keine Inhalte Dritter</h2>
    <p>
        Schriften, Skripte und Stylesheets werden ausschließlich von unserem eigenen Server geladen. Beim
        Anzeigen unserer Seiten werden keine Daten an Google oder andere Drittanbieter übertragen.
    </p>
@endif

<h2>{{ $num() }}Links auf andere Websites</h2>
<p>
    Unsere Seiten verlinken auf externe Angebote, etwa auf Portale der Länder und Kommunen. Beim Anklicken
    verlassen Sie unsere Website; für die Datenverarbeitung dort ist der jeweilige Betreiber
    verantwortlich. Beim bloßen Anzeigen unserer Seiten werden keine Daten an diese Anbieter übertragen.
</p>

<h2>{{ $num() }}Verschlüsselung</h2>
<p>
    Die Website nutzt TLS-Verschlüsselung (https). Daten, die Sie an uns übermitteln, können von Dritten
    nicht mitgelesen werden.
</p>

<h2>{{ $num() }}Ihre Rechte</h2>
<p>
    Sie haben uns gegenüber das Recht auf Auskunft über Ihre gespeicherten Daten (Art. 15 DSGVO), auf
    Berichtigung (Art. 16), Löschung (Art. 17), Einschränkung der Verarbeitung (Art. 18),
    Datenübertragbarkeit (Art. 20) und Widerspruch gegen Verarbeitungen auf Grundlage von
    Art. 6 Abs. 1 lit. f DSGVO (Art. 21). Eine erteilte Einwilligung können Sie jederzeit mit Wirkung für
    die Zukunft widerrufen. Wenden Sie sich dazu an die oben genannte Adresse.
</p>
<p>
    Außerdem haben Sie das Recht, sich bei einer Datenschutz-Aufsichtsbehörde zu beschweren. Für uns
    zuständig ist die Sächsische Datenschutz- und Transparenzbeauftragte, Devrientstraße 5, 01067 Dresden,
    <a href="{{ $auth['url'] ?? 'https://www.datenschutz.sachsen.de/' }}" rel="noopener">www.datenschutz.sachsen.de</a>.
</p>

<h2>{{ $num() }}Pflicht zur Bereitstellung</h2>
<p>
    Sie sind nicht verpflichtet, uns personenbezogene Daten bereitzustellen. Ohne die als Pflichtangaben
    gekennzeichneten Daten können wir eine Bestellung jedoch nicht bearbeiten.
</p>

<h2>{{ $num() }}Änderungen dieser Erklärung</h2>
<p>
    Wir passen diese Erklärung an, wenn sich unsere Datenverarbeitung oder die Rechtslage ändert. Es gilt
    die jeweils auf dieser Seite veröffentlichte Fassung.
</p>

<x-legal::stand />
