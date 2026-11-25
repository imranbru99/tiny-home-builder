@extends('layouts.app')

@section('title', $post->title.' | Nestline Blog')

@section('content')
<article class="mx-auto max-w-3xl px-4 py-16">
    <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" class="h-64 w-full rounded-2xl object-cover md:h-80">
    <h1 class="mt-8 font-display text-4xl font-bold text-alpine">{{ $post->title }}</h1>
    <p class="mt-3 text-ink/60">{{ optional($post->published_at)->format('M j, Y') }}</p>
    <div class="prose mt-8 max-w-none whitespace-pre-line text-ink/80">{{ $post->body }}</div>
</article>
@endsection
