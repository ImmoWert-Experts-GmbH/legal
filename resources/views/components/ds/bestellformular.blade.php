@php($c = (array) config('immowert-legal.company'))

{{-- 10x ist die eigene Bestellplattform des Unternehmens (kein externer Dienstleister, kein
     Auftragsverarbeiter). services.bestellformular: true = eingebettetes Formular (iframe),
     'api' = eigenes Formular des Portals, Uebermittlung Server-zu-Server an 10x (Shop-API). --}}
@if (config('immowert-legal.services.bestellformular') === 'api')
<h3>Bestellformular auf dieser Website</h3>
<p>
    Das Bestellformular ist Teil dieser Website. Nach dem Absenden übermittelt unser Server Ihre Angaben
    verschlüsselt an unsere eigene Bestellplattform 10x (client.10-x.eu), über die wir Bestellungen anlegen
    und abwickeln. Ihr Browser baut dabei keine Verbindung zur Bestellplattform auf; eine Weitergabe an Dritte
    findet dabei nicht statt. Zum Schutz vor missbräuchlichen Absendungen setzt die Bestellseite ein
    technisch notwendiges Sitzungs-Cookie, das beim Schließen des Browsers gelöscht wird. Rechtsgrundlage ist
    Art. 6 Abs. 1 lit. b DSGVO (Vorbereitung und Durchführung des Vertrags).
</p>
@else
<h3>Eingebettetes Bestellformular</h3>
<p>
    Das Bestellformular stammt von unserer eigenen Bestellplattform 10x (client.10-x.eu) und wird als
    eingebetteter Bereich in diese Seite geladen. Beim Laden der Bestellseite überträgt Ihr Browser
    IP-Adresse, Browserdaten und die aufgerufene Seite an den Server der Bestellplattform; die im Formular
    eingegebenen Daten werden dort erhoben und verarbeitet. Eine Weitergabe an Dritte findet dabei nicht
    statt. Rechtsgrundlage für die Einbindung ist Art. 6 Abs. 1 lit. b DSGVO (Vorbereitung und
    Durchführung des Vertrags).
</p>
@endif

<h3>Verarbeitete Daten und Zweck</h3>
<p>
    Zur Ausführung Ihrer Bestellung verarbeiten wir die Grundstücksangaben (Adresse, gegebenenfalls
    Gemarkung, Flur, Flurstück, Stichtag, Zweck), Ihre Kontakt- und Rechnungsdaten (Name, Anschrift,
    E-Mail-Adresse, gegebenenfalls Telefon und Firma) sowie Datum, Uhrzeit und IP-Adresse der Bestellung.
    Zweck ist die Beantragung der Auskunft bei der zuständigen Stelle, die Zustellung der Auskunft, die
    Rechnungsstellung und die Bearbeitung von Rückfragen. Rechtsgrundlage ist Art. 6 Abs. 1 lit. b DSGVO;
    die Speicherung der IP-Adresse dient der Missbrauchsabwehr (Art. 6 Abs. 1 lit. f DSGVO).
</p>

<h3>Weitergabe an die zuständige Stelle</h3>
<p>
    Die Angaben zum Grundstück und, soweit die zuständige Stelle es verlangt, Ihr Name werden an die
    örtlich zuständige Behörde übermittelt, weil nur diese die amtliche Auskunft erteilen kann. Ohne diese
    Übermittlung ist die Leistung nicht möglich (Art. 6 Abs. 1 lit. b DSGVO).
</p>

<h3>E-Mail-Kommunikation</h3>
<p>
    Bestellbestätigung, Rückfragen, Rechnung und die Auskunft selbst senden wir an die angegebene
    E-Mail-Adresse. Der Versand läuft über den Mailserver unseres Hostinganbieters.
</p>

<h3>Speicherdauer</h3>
<p>
    Bestell- und Rechnungsdaten bewahren wir für die Dauer der gesetzlichen Aufbewahrungsfristen auf (sechs
    beziehungsweise zehn Jahre nach § 257 HGB und § 147 AO) und löschen sie danach. Die IP-Adresse der
    Bestellung wird spätestens nach 30 Tagen gelöscht.
</p>
