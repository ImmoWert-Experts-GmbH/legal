@php($c = (array) config('immowert-legal.company'))

{{-- Kostenlose Dokumentauswertung ("Grundbuchauszug-Check" und spaetere
     Werkzeuge). Der Besucher laedt freiwillig ein Dokument hoch; ausgewertet
     wird bei amtfinder.de, der Modellanbieter ist Unterauftragsverarbeiter.

     Grundlage ist ausschliesslich die Einwilligung vor dem Upload - ohne
     Haekchen verlaesst die Datei den Rechner nicht. Deshalb steht hier auch
     der Widerruf und die Drittlandfrage. --}}

<h3>Was das Werkzeug tut</h3>
<p>
    Auf unserer Seite können Sie ein Dokument — etwa einen Grundbuchauszug — freiwillig und kostenlos
    hochladen, um es automatisiert ordnen und die enthaltenen Fachbegriffe erklären zu lassen. Die
    Nutzung ist für die übrigen Angebote der Seite nicht erforderlich; ohne Upload steht Ihnen die
    Seite unverändert zur Verfügung.
</p>

<h3>Empfänger und Ablauf</h3>
<p>
    Die Datei wird aus Ihrem Browser unmittelbar an amtfinder.de übertragen und dort verarbeitet; auf
    dem Webserver dieser Website wird sie zu keinem Zeitpunkt gespeichert. amtfinder.de ist ein
    weiterer Dienst desselben Unternehmens ({{ $c['name'] }}, Anschrift wie oben), betrieben auf
    Servern in Deutschland. Für das Auslesen des Dokuments wird ein KI-Modell eingesetzt, dessen
    Anbieter als Auftragsverarbeiter nach Art. 28 DSGVO gebunden ist; eine Nutzung Ihrer Daten zum
    Training der Modelle ist
    vertraglich und technisch ausgeschlossen. Der Inhalt des Dokuments kann dabei auch außerhalb der
    Europäischen Union verarbeitet werden — mit Ihrer Einwilligung nach Art. 49 Abs. 1 lit. a DSGVO.
    Die Zusammenfassung wird ohne die im Dokument enthaltenen Namen erzeugt.
</p>

<h3>Rechtsgrundlage und Widerruf</h3>
<p>
    Rechtsgrundlage ist Ihre Einwilligung nach Art. 6 Abs. 1 lit. a DSGVO, die Sie vor dem Upload
    ausdrücklich erteilen. Sie können sie jederzeit mit Wirkung für die Zukunft widerrufen; die
    Rechtmäßigkeit der bis dahin erfolgten Verarbeitung bleibt unberührt. Ein Widerruf ist praktisch
    dadurch erledigt, dass die hochgeladene Datei ohnehin unmittelbar nach der Auswertung gelöscht
    wird; darüber hinaus genügt eine formlose Nachricht an uns.
</p>

<h3>Speicherdauer</h3>
<p>
    Die hochgeladene Datei wird direkt nach der Auswertung gelöscht. Der Dateiname wird nicht
    gespeichert. Das Auswertungsergebnis wird verschlüsselt abgelegt und spätestens nach zwei Stunden
    gelöscht. Erhalten bleibt für 30 Tage ein Protokolleintrag ohne Dokumentinhalt (Zeitpunkt, Status,
    Dauer, Fehlercode) zur Fehlersuche und Abrechnung. Ihre IP-Adresse wird nicht im Klartext
    gespeichert, sondern nur als nicht rückrechenbarer Prüfwert, um die Zahl der Uploads je Absender
    zu begrenzen (Art. 6 Abs. 1 lit. f DSGVO, Missbrauchsabwehr).
</p>

<h3>Schutz vor automatisierten Uploads</h3>
<p>
    Vor dem Upload kann eine Prüfung des Anbieters Cloudflare („Turnstile", Cloudflare Germany GmbH,
    Rosenstraße 7, 80331 München, für die Cloudflare, Inc., USA) durchlaufen werden. Dabei überträgt
    Ihr Browser IP-Adresse, Browserangaben und technische Merkmale an Cloudflare. Das Skript wird erst
    geladen, wenn Sie den Upload starten — beim bloßen Lesen der Seite nicht. Zweck ist die Abwehr
    automatisierter Massenanfragen (Art. 6 Abs. 1 lit. f DSGVO). Für die Übermittlung in die USA
    bestehen Standardvertragsklauseln; Cloudflare, Inc. ist zudem nach dem EU-US Data Privacy
    Framework zertifiziert.
</p>

<h3>Keine Rechtsberatung, kein amtlicher Nachweis</h3>
<p>
    Die Auswertung ordnet und erklärt den Inhalt des hochgeladenen Dokuments. Sie ist weder eine
    Rechtsdienstleistung im Sinne des § 2 RDG noch ein amtlicher Nachweis. Maßgeblich bleibt allein
    das Dokument der zuständigen Stelle.
</p>
