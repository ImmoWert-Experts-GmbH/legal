{-- SLOT: Widerrufsbelehrung fuer digitale Inhalte mit Muster-Widerrufsformular.

     Der Text fehlt noch und wird hier eingesetzt, sobald er inhaltlich
     freigegeben ist. Danach in config/immowert-legal.php 'texts.widerruf_digital'
     auf true setzen und eine neue Fassung schneiden (legal.py bump).
     Solange der Schalter auf false steht, registriert Legal::routes() keine
     Route mit diesem Text - der Slot wird nie leer ausgeliefert.

     Inhalt laut Anforderung (immoscore.de, ADR 0013, offene Punkte 2.5):
     - Widerrufsbelehrung fuer Vertraege ueber digitale Inhalte, die nicht
       auf einem koerperlichen Datentraeger geliefert werden
     - Erloeschen des Widerrufsrechts nach § 356 Abs. 5 BGB
     - Muster-Widerrufsformular (Anlage 2 zu Art. 246a § 1 Abs. 2 EGBGB)
     Firmendaten wie in agb.blade.php aus config('immowert-legal.company'). --}
