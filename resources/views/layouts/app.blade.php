<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Nestline Tiny Homes')</title>
    <meta name="description" content="@yield('meta_description', 'Nestline Tiny Homes — Small footprints. Big living. Serving Austin–Hill Country, TX.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Literata:opsz,wght@7..72,600;7..72,700;7..72,800&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen antialiased">
    <header class="relative z-40 border-b border-glacier/10 bg-frost/80 backdrop-blur-md">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-4">
            <a href="{{ route('home') }}" class="font-display text-xl font-extrabold tracking-tight text-alpine sm:text-2xl">
                Nestline
            </a>
            <nav class="hidden items-center gap-6 text-sm font-semibold text-ink/80 md:flex">
                <a href="{{ route('services.index') }}" class="hover:text-glacier">Services</a>
                <a href="{{ route('about') }}" class="hover:text-glacier">About</a>
                <a href="{{ route('blog.index') }}" class="hover:text-glacier">Blog</a>
                <a href="{{ route('kb.index') }}" class="hover:text-glacier">Knowledge Base</a>
                <a href="{{ route('contact') }}" class="hover:text-glacier">Contact</a>
                <a href="/admin" class="rounded-md bg-alpine px-3 py-2 text-white hover:bg-glacier">ERP Login</a>
            </nav>
            <a href="{{ route('contact') }}" class="rounded-md bg-ember px-3 py-2 text-sm font-bold text-white md:hidden">Consult</a>
        </div>
    </header>

    <main>
        @if (session('success'))
            <div class="mx-auto max-w-6xl px-4 pt-4">
                <div class="rounded-lg border border-glacier/20 bg-snow px-4 py-3 text-sm text-alpine">{{ session('success') }}</div>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="mt-20 border-t border-alpine/10 bg-alpine text-snow">
        <div class="mx-auto grid max-w-6xl gap-8 px-4 py-12 md:grid-cols-3">
            <div>
                <p class="font-display text-2xl font-bold text-white">Nestline</p>
                <p class="mt-2 text-sm text-snow/80">Tiny homes for Austin–Hill Country, TX. Small footprints. Big living.</p>
            </div>
            <div>
                <p class="font-semibold text-white">Visit</p>
                <p class="mt-2 text-sm text-snow/80">2108 E Cesar Chavez St<br>Austin, TX 78702<br>(512) 555-0142</p>
            </div>
            <div>
                <p class="font-semibold text-white">Explore</p>
                <div class="mt-2 flex flex-col gap-1 text-sm">
                    <a href="{{ route('services.index') }}" class="hover:text-ember">Services</a>
                    <a href="{{ route('kb.index') }}" class="hover:text-ember">Knowledge Base</a>
                    <a href="/admin" class="hover:text-ember">Staff ERP</a>
                </div>
            </div>
        </div>
        <div class="border-t border-white/10 py-4 text-center text-xs text-snow/60">
            © {{ date('Y') }} Nestline Tiny Homes. All rights reserved.
        </div>
    </footer>

    <a href="https://wa.me/15125550142" target="_blank" rel="noopener"
       class="fixed bottom-5 right-5 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-[#25D366] text-2xl text-white shadow-lg float-soft"
       aria-label="WhatsApp Nestline">💬</a>

    @include('components.chatbot')
</body>
</html>
