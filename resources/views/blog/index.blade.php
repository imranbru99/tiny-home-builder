@extends('layouts.app')

@section('title', 'Blog | Nestline')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-16">
    <h1 class="font-display text-4xl font-bold text-alpine">Blog</h1>
    <p class="mt-3 text-ink/70">Build tips, haul checklists, and Hill Country climate advice for tiny living.</p>
    <div class="mt-10 grid gap-8 md:grid-cols-3">
        @foreach ($posts as $post)
            <a href="{{ route('blog.show', $post) }}" class="block">
                <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" class="h-44 w-full rounded-xl object-cover">
                <h2 class="mt-3 font-display text-lg font-bold text-alpine">{{ $post->title }}</h2>
                <p class="mt-1 text-sm text-ink/65">{{ $post->excerpt }}</p>
            </a>
        @endforeach
    </div>
</section>
@endsection
