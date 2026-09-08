{{-- Ersetzt die bisherigen Links auf grundbuch24.de: verlinkt immer die
     Rechtstexte des eigenen Portals. --}}
@php($r = (array) config('immowert-legal.routes'))

@if (($r['impressum']['enabled'] ?? true) && Route::has($r['impressum']['name'] ?? 'impressum'))
    <a href="{{ route($r['impressum']['name']) }}">Impressum</a>
@endif
@if (($r['datenschutz']['enabled'] ?? true) && Route::has($r['datenschutz']['name'] ?? 'datenschutz'))
    <a href="{{ route($r['datenschutz']['name']) }}">Datenschutz</a>
@endif
@if (($r['agb']['enabled'] ?? true) && Route::has($r['agb']['name'] ?? 'agb'))
    <a href="{{ route($r['agb']['name']) }}">AGB</a>
@endif
