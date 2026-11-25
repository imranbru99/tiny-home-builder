@extends('layouts.app')

@section('title', 'Contact Nestline Tiny Homes')

@section('content')
<section class="mx-auto max-w-3xl px-4 py-16">
    <h1 class="font-display text-4xl font-bold text-alpine">Request a design consult</h1>
    <p class="mt-3 text-ink/70">Tell us about your tiny-home goals — towable, park model, or foundation-set. We reply within one business day.</p>

    <form method="POST" action="{{ route('contact.store') }}" class="mt-8 space-y-4 rounded-2xl border border-alpine/10 bg-white/80 p-6 shadow-sm">
        @csrf
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="text-sm font-semibold">Name</label>
                <input name="name" value="{{ old('name') }}" required class="mt-1 w-full rounded-lg border border-alpine/15 px-3 py-2">
                @error('name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-sm font-semibold">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full rounded-lg border border-alpine/15 px-3 py-2">
                @error('email') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="text-sm font-semibold">Phone</label>
                <input name="phone" value="{{ old('phone') }}" class="mt-1 w-full rounded-lg border border-alpine/15 px-3 py-2">
            </div>
            <div>
                <label class="text-sm font-semibold">Subject</label>
                <input name="subject" value="{{ old('subject') }}" class="mt-1 w-full rounded-lg border border-alpine/15 px-3 py-2">
            </div>
        </div>
        <div>
            <label class="text-sm font-semibold">Message</label>
            <textarea name="message" rows="5" required class="mt-1 w-full rounded-lg border border-alpine/15 px-3 py-2">{{ old('message') }}</textarea>
            @error('message') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <button class="rounded-md bg-alpine px-5 py-3 text-sm font-bold text-white">Send message</button>
    </form>
</section>
@endsection
