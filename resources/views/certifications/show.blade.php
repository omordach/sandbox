@extends('layouts.app')

@section('title', $cert->title . ' — Certification')
@section('meta_description', ($cert->issuer ? ($cert->issuer . ' • ') : '') . ($cert->issued_at?->format('Y-m') ?? ''))

@section('content')
    <a href="{{ route('certifications.index') }}" class="text-blue-600 hover:underline">&larr; Back to certifications</a>

    <div class="bg-white rounded-lg shadow-sm p-6 mt-4">
        <h1 class="text-2xl font-semibold">{{ $cert->title }}</h1>
        @if($cert->issuer)
            <div class="text-gray-700 mt-1">{{ $cert->issuer }}</div>
        @endif
        @if($cert->issued_at)
            <div class="text-gray-500 text-sm">Issued: {{ $cert->issued_at->toFormattedDateString() }}</div>
        @endif

        <div class="mt-6 flex justify-center">
            {!! \App\Helpers\Credly::iframeFromUrl($cert->credly_url, 300, 300) ?: $cert->embedHtmlSafe() !!}
        </div>

        @if($cert->credly_url)
            <div class="mt-6 flex items-center gap-3">
                <a href="{{ $cert->credly_url }}" target="_blank" rel="noopener" class="text-blue-600 hover:underline">View on Credly</a>
                <copy-link url="{{ $cert->credly_url }}"></copy-link>
            </div>
        @endif
    </div>
@endsection

