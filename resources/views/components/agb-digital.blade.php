{-- SLOT: AGB fuer digitale Einzeldokumente (nicht amtlich).

     Der Text fehlt noch und wird hier eingesetzt, sobald er inhaltlich
     freigegeben ist. Danach in config/immowert-legal.php 'texts.agb_digital'
     auf true setzen und eine neue Fassung schneiden (legal.py bump).
     Solange der Schalter auf false steht, registriert Legal::routes() keine
     Route mit diesem Text - der Slot wird nie leer ausgeliefert.

     Inhalt laut Anforderung (immoscore.de, ADR 0013, offene Punkte 2.5):
     - Vertrag ueber digitale Einzeldokumente (Flurkarte, Bodenrichtwert-
       Auszug, Bericht), jeweils mit Vermerk "nicht amtlich"
     - Vertragsschluss, Preise, Zahlung, Bereitstellung, Gewaehrleistung
       fuer digitale Produkte, Haftung, Streitbeilegung
     Firmendaten wie in agb.blade.php aus config('immowert-legal.company'). --}
