@extends('layouts.app')

@section('title', 'Home — Oleh Mordach')
@section('meta_description', 'Profile and top certifications of Oleh Mordach.')

@section('content')
    <section class="py-12">
        <div class="grid gap-8 lg:grid-cols-2 items-center">
            <div>
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Ship faster with a clean UI</h1>
                <p class="mt-4 text-lg text-[hsl(var(--muted))]">Tokens, dark mode and accessible components out of the box.</p>
                <div class="mt-6 flex gap-3">
                    <a href="/certifications" class="btn-primary">Explore Certifications</a>
                    <a href="#about" class="btn-ghost">About</a>
                </div>
            </div>
            <div class="card p-6">
                <h2 class="text-xl font-semibold">Highlights</h2>
                <ul class="mt-4 grid gap-3">
                    <li class="badge">Dark mode</li>
                    <li class="badge">TypeScript</li>
                    <li class="badge">A11y-first</li>
                    <li class="badge">Responsive</li>
                </ul>
            </div>
        </div>
    </section>
    <section id="about" class="mb-8">
        <div class="bg-white rounded-lg shadow-sm p-4">
            <h1 class="text-2xl font-semibold mb-2">About</h1>
            <p class="text-lg font-medium">{{ $profile['name'] ?? 'Oleh Mordach' }}</p>
            <p class="text-gray-700">{{ $profile['role'] ?? '' }}</p>
            <p class="text-gray-600 mt-1">{{ $profile['location'] ?? '' }}</p>
            <p class="mt-3">{{ $profile['summary'] ?? '' }}</p>
            @if(!empty($profile['links']))
                <div class="mt-3 flex gap-4 text-blue-600">
                    @foreach($profile['links'] as $link)
                        <a href="{{ $link['url'] }}" target="_blank" rel="noopener" class="hover:underline">{{ $link['label'] }}</a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold">Certifications</h2>
            <a href="{{ route('certifications.index') }}" class="text-blue-600 hover:underline">View all</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($certifications as $cert)
                <a href="{{ route('certifications.show', $cert->slug) }}" class="block bg-white rounded-lg shadow-sm p-4 hover:shadow">
                    <div class="flex items-start gap-4">
                        <div class="shrink-0">
                            {!! $cert->embedHtmlSafe() ?: (\App\Helpers\Credly::iframeFromUrl($cert->credly_url, 150, 150) ?? '') !!}
                        </div>
                        <div class="min-w-0">
                            <div class="font-medium truncate">{{ $cert->title }}</div>
                            @if($cert->issuer)
                                <div class="text-gray-600 text-sm">{{ $cert->issuer }}</div>
                            @endif
                            @if($cert->issued_at)
                                <div class="text-gray-500 text-xs mt-1">{{ $cert->issued_at->format('Y-m') }}</div>
                            @endif
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-gray-600">No certifications yet.</p>
            @endforelse
        </div>
    </section>
@endsection
