@extends('layouts.app')

@section('title', 'Nestline Tiny Homes | Austin–Hill Country, TX')
@section('meta_description', 'Nestline Tiny Homes — Custom tiny homes built for freedom, not compromise.')

@section('content')
<section class="relative min-h-[88vh] overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1518780664697-55e3ad937233?auto=format&fit=crop&w=2000&q=80"
             alt="Compact modern tiny home exterior in a green landscape"
             class="hero-pan h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-alpine/92 via-alpine/72 to-alpine/20"></div>
    </div>
    <div class="relative mx-auto flex min-h-[88vh] max-w-6xl flex-col justify-center px-4 py-20 text-white">
        <p class="fade-up font-display text-5xl font-extrabold tracking-tight sm:text-7xl">Nestline</p>
        <h1 class="fade-up mt-4 max-w-xl text-2xl font-semibold text-snow sm:text-3xl" style="animation-delay:.12s">
            Custom tiny homes built for freedom, not compromise.
        </h1>
        <p class="fade-up mt-4 max-w-lg text-base text-snow/85 sm:text-lg" style="animation-delay:.22s">
            Small footprints. Big living. Serving Austin–Hill Country, TX with production-quality builds and clear milestones.
        </p>
        <div class="fade-up mt-8 flex flex-wrap gap-3" style="animation-delay:.32s">
            <a href="{{ route('contact') }}" class="rounded-md bg-ember px-5 py-3 text-sm font-bold text-white">Book design consult</a>
            <a href="{{ route('services.index') }}" class="rounded-md border border-white/40 px-5 py-3 text-sm font-semibold text-white hover:bg-white/10">View services</a>
        </div>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-20">
    <div class="max-w-2xl">
        <h2 class="font-display text-3xl font-bold text-alpine sm:text-4xl">Small footprints. Big living.</h2>
        <p class="mt-3 text-ink/70">One project lead, clear milestones, and shells engineered for Texas heat, haul routes, and code.</p>
    </div>
    <div class="mt-10 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($services->take(6) as $service)
            <a href="{{ route('services.show', $service) }}" class="group block">
                <div class="overflow-hidden rounded-2xl">
                    <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="h-48 w-full object-cover transition duration-500 group-hover:scale-105">
                </div>
                <h3 class="mt-4 font-display text-xl font-bold text-alpine">{{ $service->name }}</h3>
                <p class="mt-1 text-sm text-ink/70">{{ $service->tagline }}</p>
            </a>
        @endforeach
    </div>
</section>

<section class="bg-alpine text-snow">
    <div class="mx-auto grid max-w-6xl items-center gap-10 px-4 py-20 md:grid-cols-2">
        <div>
            <h2 class="font-display text-3xl font-bold text-white sm:text-4xl">About Nestline</h2>
            <p class="mt-4 text-snow/80">
                We are an Austin-based tiny-home studio focused on road-ready and foundation-set dwellings — efficient shells, smart storage, and finishes that feel intentional.
            </p>
            <a href="{{ route('about') }}" class="mt-6 inline-block rounded-md bg-glacier px-4 py-2 text-sm font-semibold text-white">Our story</a>
        </div>
        <img src="https://images.unsplash.com/photo-1542718610-a1d656d1884c?auto=format&fit=crop&w=1200&q=80"
             alt="Warm wood-clad tiny home living interior"
             class="h-80 w-full rounded-2xl object-cover">
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-20">
    <div class="max-w-2xl">
        <h2 class="font-display text-3xl font-bold text-alpine">Operations dashboard preview</h2>
        <p class="mt-3 text-ink/70">Staff run projects, inventory, invoices, and AI assistants from the Nestline ERP.</p>
    </div>
    <div class="mt-8 overflow-hidden rounded-3xl border border-alpine/10 bg-white shadow-xl">
        <img src="https://images.unsplash.com/photo-1480074568708-e7b720bb3f09?auto=format&fit=crop&w=1600&q=80"
             alt="Craftsman exterior detailing on a small dwelling"
             class="h-72 w-full object-cover md:h-96">
        <div class="grid gap-4 p-6 sm:grid-cols-3">
            <div>
                <p class="text-xs uppercase tracking-wide text-glacier">Active projects</p>
                <p class="font-display text-3xl font-bold text-alpine">14</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-wide text-glacier">Crews today</p>
                <p class="font-display text-3xl font-bold text-alpine">5</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-wide text-glacier">Consults booked</p>
                <p class="font-display text-3xl font-bold text-alpine">9</p>
            </div>
        </div>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 pb-20">
    <div class="flex items-end justify-between gap-4">
        <h2 class="font-display text-3xl font-bold text-alpine">From the knowledge bench</h2>
        <a href="{{ route('blog.index') }}" class="text-sm font-semibold text-glacier">All posts</a>
    </div>
    <div class="mt-8 grid gap-8 md:grid-cols-3">
        @foreach ($posts as $post)
            <a href="{{ route('blog.show', $post) }}" class="block">
                <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" class="h-44 w-full rounded-xl object-cover">
                <h3 class="mt-3 font-display text-lg font-bold text-alpine">{{ $post->title }}</h3>
                <p class="mt-1 text-sm text-ink/65">{{ $post->excerpt }}</p>
            </a>
        @endforeach
    </div>
</section>

<section class="border-t border-alpine/10 bg-snow/60">
    <div class="mx-auto flex max-w-6xl flex-col items-start justify-between gap-6 px-4 py-16 md:flex-row md:items-center">
        <div>
            <h2 class="font-display text-3xl font-bold text-alpine">Ready to downsize without downgrading?</h2>
            <p class="mt-2 text-ink/70">Free design consults across Austin–Hill Country. WhatsApp or form — your choice.</p>
        </div>
        <a href="{{ route('contact') }}" class="rounded-md bg-alpine px-5 py-3 text-sm font-bold text-white">Contact Nestline</a>
    </div>
</section>
@endsection
