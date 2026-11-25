@extends('layouts.app')

@section('title', $service->name.' | Nestline')

@section('content')
<section class="mx-auto max-w-4xl px-4 py-16">
    <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="h-72 w-full rounded-2xl object-cover md:h-96">
    <h1 class="mt-8 font-display text-4xl font-bold text-alpine">{{ $service->name }}</h1>
    <p class="mt-2 text-lg text-glacier">{{ $service->tagline }}</p>
    <p class="mt-6 whitespace-pre-line text-ink/80">{{ $service->description }}</p>
    @if ($service->base_price)
        <p class="mt-6 text-sm font-semibold text-alpine">Starting around ${{ number_format($service->base_price) }}</p>
    @endif
    <a href="{{ route('contact') }}" class="mt-8 inline-block rounded-md bg-alpine px-5 py-3 text-sm font-bold text-white">Request consult</a>
</section>
@endsection
