@extends('layouts.app')

@section('title', $article->title.' | Nestline KB')

@section('content')
<article class="mx-auto max-w-3xl px-4 py-16">
    <p class="text-xs uppercase tracking-wide text-glacier">{{ str_replace('-', ' ', $article->category) }}</p>
    <h1 class="mt-2 font-display text-4xl font-bold text-alpine">{{ $article->title }}</h1>
    <p class="mt-4 text-ink/70">{{ $article->summary }}</p>
    <div class="prose mt-8 max-w-none whitespace-pre-line text-ink/80">{{ $article->body }}</div>
</article>
@endsection
