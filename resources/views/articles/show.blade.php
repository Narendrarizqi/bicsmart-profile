@extends('layouts.app')
@section('title', $article->title)
@section('description', $article->excerpt)
@section('og_type', 'article')
@if ($article->image_url) @section('og_image', $article->image_url) @endif

@push('jsonld')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'NewsArticle',
    'headline' => $article->title,
    'description' => $article->excerpt,
    'image' => $article->image_url ? [$article->image_url] : [asset('images/brand-roadmap-2030.png')],
    'datePublished' => $article->published_at->toIso8601String(),
    'dateModified' => $article->updated_at->toIso8601String(),
    'author' => ['@type' => 'Organization', 'name' => 'Tim BiC-SMART'],
    'publisher' => ['@id' => url('/').'#org'],
    'mainEntityOfPage' => url()->current(),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('content')
<article>
    <header class="border-b border-navy-100 bg-white">
        <div class="container-page max-w-4xl py-10 sm:py-14">
            <nav class="text-sm text-slate-500" aria-label="Breadcrumb"><a href="{{ route('berita.index') }}" class="hover:text-emerald-700">Berita</a> <span aria-hidden="true">/</span> <span>{{ $article->category_label }}</span></nav>
            <h1 class="mt-4 text-3xl font-extrabold leading-tight sm:text-4xl lg:text-5xl">{{ $article->title }}</h1>
            <p class="mt-4 flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-slate-500">
                <span class="inline-flex items-center gap-1"><x-ui-icon name="calendar" class="h-4 w-4" /><time datetime="{{ $article->published_at->toDateString() }}">{{ $article->published_at->translatedFormat('l, d F Y') }}</time></span>
                <span>{{ $article->reading_minutes }} menit baca</span>
                <span>Tim BiC-SMART</span>
            </p>
        </div>
    </header>
    <div class="container-page max-w-4xl py-10">
        @if ($article->image_url)
            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="mb-10 aspect-[16/9] w-full rounded-bento object-cover shadow-bento" fetchpriority="high">
        @endif
        @if ($article->summary)
            <p class="mb-8 border-l-4 border-emerald-500 pl-5 text-xl leading-relaxed text-navy-800">{{ $article->summary }}</p>
        @endif
        <div class="prose prose-lg prose-slate max-w-none prose-headings:font-display prose-headings:text-navy-800 prose-a:text-emerald-700 prose-strong:text-navy-800 prose-img:rounded-2xl">
            {!! str($article->content)->sanitizeHtml() !!}
        </div>
        @if (! empty($article->gallery))
            <h2 class="mb-4 mt-12 text-2xl font-bold">Galeri</h2>
            @include('partials.gallery', ['photos' => collect($article->gallery)->map(fn ($p) => Storage::disk('public')->url($p))->all(), 'title' => $article->title])
        @endif
        <div class="mt-12 flex flex-wrap items-center gap-3 border-t border-navy-100 pt-6" x-data="{ copied: false }">
            <span class="text-sm font-semibold text-navy-800">Bagikan:</span>
            <a class="btn-ghost py-2" target="_blank" rel="noopener" href="https://wa.me/?text={{ urlencode($article->title.' '.url()->current()) }}">WhatsApp</a>
            <a class="btn-ghost py-2" target="_blank" rel="noopener" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}">Facebook</a>
            <button type="button" class="btn-ghost py-2" @click="navigator.clipboard.writeText(location.href); copied = true; setTimeout(() => copied = false, 2000)" x-text="copied ? 'Tautan disalin ✓' : 'Salin tautan'">Salin tautan</button>
        </div>
    </div>
</article>

@if ($related->isNotEmpty())
<section class="pb-10">
    <div class="container-page">
        <h2 class="text-2xl font-bold">Berita lainnya</h2>
        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($related as $r)<x-article-card :article="$r" />@endforeach
        </div>
    </div>
</section>
@endif
@endsection
