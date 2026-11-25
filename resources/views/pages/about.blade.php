@extends('layouts.app')

@section('title', 'About Nestline Tiny Homes')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-16">
    <p class="font-display text-5xl font-extrabold text-alpine">Nestline</p>
    <h1 class="mt-3 text-2xl font-semibold text-ink/80">Small footprints. Big living.</h1>
    <div class="mt-10 grid gap-10 md:grid-cols-2">
        <img src="https://images.unsplash.com/photo-1523217582562-09d0def993a6?auto=format&fit=crop&w=1400&q=80"
             alt="Warm wood-clad tiny home living interior"
             class="h-80 w-full rounded-2xl object-cover">
        <div class="space-y-4 text-ink/80">
            <p>We are an Austin-based tiny-home studio focused on road-ready and foundation-set dwellings — efficient shells, smart storage, and finishes that feel intentional.</p>
            <p>We coordinate design, permitting, and production-aware builds. The ERP at /admin is the same system that schedules crews, tracks inventory, and invoices by milestone.</p>
            <p>Service area: Austin, Round Rock, Dripping Springs, Wimberley, Bastrop, San Marcos.</p>
        </div>
    </div>
</section>
@endsection
