{{-- Wrapper: bringt den zentralen Rechtstext ins Layout dieses Portals.
     NUR das Layout drumherum gehoert hierhin - der Text selbst kommt aus
     immowert/legal und wird dort gepflegt. --}}
@extends('layouts.app')

@section('title', 'Allgemeine Geschäftsbedingungen')
@section('robots', 'noindex,follow')

@section('content')
    <section class="wrap" style="max-width:46rem;margin:0 auto;padding:3rem 1rem">
        <h1>Allgemeine Geschäftsbedingungen</h1>
        <div class="prose">
            <x-legal::agb />
        </div>
    </section>
@endsection
