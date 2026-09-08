{{-- Macht von aussen sichtbar, welcher Paketstand auf diesem Portal liegt. --}}
<p class="text-sm opacity-70">
    Stand: {{ \Illuminate\Support\Carbon::parse(config('immowert-legal.stand'))->format('d.m.Y') }}
    (Fassung {{ config('immowert-legal.version') }})
</p>
