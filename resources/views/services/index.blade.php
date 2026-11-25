@extends('layouts.app')

@section('title', 'Tiny Home Services | Nestline')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-16">
    <h1 class="font-display text-4xl font-bold text-alpine">Tiny home services</h1>
    <p class="mt-3 max-w-2xl text-ink/70">One project lead, clear milestones, and shells engineered for Texas heat, haul routes, and code.</p>
    <div class="mt-10 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($services as $service)
            <a href="{{ route('services.show', $service) }}" class="group block">
                <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="h-48 w-full rounded-2xl object-cover transition duration-500 group-hover:scale-105">
                <h2 class="mt-4 font-display text-xl font-bold text-alpine">{{ $service->name }}</h2>
                <p class="mt-1 text-sm text-ink/70">{{ $service->summary }}</p>
            </a>
        @endforeach
    </div>
</section>
@endsection
