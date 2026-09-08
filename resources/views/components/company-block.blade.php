{{-- Firmenblock. Einzige Quelle: config('immowert-legal.company'). --}}
@php($c = (array) config('immowert-legal.company'))

<address class="not-italic">
    @if (!empty($c['prefix']))<span>{{ $c['prefix'] }}</span><br>@endif
    <strong>{{ $c['name'] }}</strong><br>
    {{ $c['street'] }}<br>
    {{ $c['postal_code'] }} {{ $c['city'] }}
</address>
