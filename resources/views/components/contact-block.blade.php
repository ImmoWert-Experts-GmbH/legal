@php($c = (array) config('immowert-legal.company'))

<p>
    E-Mail: <a href="mailto:{{ $c['email'] }}">{{ $c['email'] }}</a>
    @if (!empty($c['phone']))<br>Telefon: {{ $c['phone'] }}@endif
    @if (!empty($c['fax']))<br>Telefax: {{ $c['fax'] }}@endif
</p>
