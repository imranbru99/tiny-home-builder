@extends('layouts.app')

@section('title', 'Knowledge Base | Nestline')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-16">
    <h1 class="font-display text-4xl font-bold text-alpine">Knowledge Base</h1>
    <p class="mt-3 max-w-2xl text-ink/70">Homeowner guides, admin manual excerpts, and troubleshooting for tiny-home operations.</p>
    <div class="mt-10 grid gap-6 md:grid-cols-2">
        @foreach ($articles as $article)
            <a href="{{ route('kb.show', $article) }}" class="rounded-2xl border border-alpine/10 bg-white/80 p-6 shadow-sm">
                <p class="text-xs uppercase tracking-wide text-glacier">{{ str_replace('-', ' ', $article->category) }}</p>
                <h2 class="mt-2 font-display text-xl font-bold text-alpine">{{ $article->title }}</h2>
                <p class="mt-2 text-sm text-ink/70">{{ $article->summary }}</p>
            </a>
        @endforeach
    </div>
</section>
@endsection
