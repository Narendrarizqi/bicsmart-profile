@extends('layouts.app')
@section('title', 'Berita & Rilis Media')
@section('description', 'Berita kegiatan, rilis media, dan artikel edukasi DBD & Wolbachia dari program BiC-SMART.')

@section('content')
<x-page-hero eyebrow="Berita & Edukasi" title="Kabar dari BiC-SMART" lead="Berita kegiatan, rilis media, dan artikel edukasi seputar DBD dan Wolbachia.">
    <form method="get" class="mt-8 flex max-w-2xl flex-col gap-2 sm:flex-row">
        <label class="sr-only" for="q">Cari berita</label>
        <div class="relative flex-1">
            <x-ui-icon name="search" class="pointer-events-none absolute left-3.5 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" />
            <input id="q" name="q" value="{{ $q }}" placeholder="Cari judul berita…" class="input pl-11">
        </div>
        @if ($category)<input type="hidden" name="kategori" value="{{ $category }}">@endif
        <button class="btn-navy">Cari</button>
    </form>
</x-page-hero>

<section class="section">
    <div class="container-page">
        <nav class="flex flex-wrap gap-2" aria-label="Filter kategori">
            <a href="{{ route('berita.index', array_filter(['q' => $q])) }}" @class(['badge px-4 py-2 text-sm', 'bg-navy-800 text-white ring-navy-800' => ! $category, 'bg-white text-navy-700 ring-navy-200 hover:bg-navy-50' => $category])>Semua</a>
            @foreach (\App\Models\Article::CATEGORIES as $key => $label)
                <a href="{{ route('berita.index', array_filter(['kategori' => $key, 'q' => $q])) }}" @class(['badge px-4 py-2 text-sm', 'bg-navy-800 text-white ring-navy-800' => $category === $key, 'bg-white text-navy-700 ring-navy-200 hover:bg-navy-50' => $category !== $key])>{{ $label }}</a>
            @endforeach
        </nav>

        <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($articles as $article)
                <x-article-card :article="$article" />
            @empty
                <div class="bento text-center sm:col-span-2 lg:col-span-3">
                    <img src="{{ asset('images/mascot-avatar.webp') }}" alt="" class="mx-auto h-24 w-auto" loading="lazy">
                    <p class="mt-3 font-semibold text-navy-800">Belum ada berita yang cocok.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-10">{{ $articles->links() }}</div>
    </div>
</section>
@endsection
