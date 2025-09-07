@extends('layouts.app')

@section('title', 'Certifications')
@section('meta_description', 'Public list of certifications.')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Certifications</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @forelse($certifications as $cert)
            <div class="card p-4 hover:shadow-soft">
                <div class="cert-embed mb-3">
                    {!! $cert->embedHtmlSafe() ?: (\App\Helpers\Credly::iframeFromUrl($cert->credly_url, 300, 300) ?? '') !!}
                </div>
                <div class="font-medium">{{ $cert->title }}</div>
                @if($cert->issuer)
                    <div class="text-gray-600 text-sm">{{ $cert->issuer }}</div>
                @endif
                @if($cert->issued_at)
                    <div class="text-gray-500 text-xs mt-1">{{ $cert->issued_at->format('Y-m') }}</div>
                @endif
                <div class="mt-2 text-sm">
                    <a href="{{ route('certifications.show', $cert->slug) }}" class="text-blue-600 hover:underline">Details</a>
                </div>
            </div>
        @empty
            <p class="text-gray-600">No certifications found.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $certifications->links() }}
    </div>
@endsection
