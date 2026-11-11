@extends('layouts.app')
@section('title', $activity->title)
@section('description', \Illuminate\Support\Str::limit($activity->description, 155))
@if ($activity->cover_url) @section('og_image', $activity->cover_url) @endif

@section('content')
<article class="container-page max-w-5xl py-10 sm:py-14">
    <nav class="text-sm text-slate-500" aria-label="Breadcrumb"><a href="{{ route('dokumentasi') }}" class="hover:text-emerald-700">Dokumentasi</a> <span aria-hidden="true">/</span> {{ $activity->activity_date->translatedFormat('d F Y') }}</nav>
    <div class="mt-4 grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <span class="badge {{ $activity->category_color }}">{{ $activity->category_label }}</span>
            <h1 class="mt-3 text-3xl font-extrabold leading-tight sm:text-4xl">{{ $activity->title }}</h1>
            <div class="mt-6 whitespace-pre-line text-lg leading-relaxed text-slate-700">{{ $activity->description }}</div>
        </div>
        <aside class="bento h-fit space-y-4 text-sm">
            <p class="flex gap-3"><x-ui-icon name="calendar" class="h-5 w-5 shrink-0 text-emerald-600" /><span><b class="block text-navy-800">Tanggal</b>{{ $activity->activity_date->translatedFormat('l, d F Y') }}</span></p>
            @if ($activity->place_label)
                <p class="flex gap-3"><x-ui-icon name="map-pin" class="h-5 w-5 shrink-0 text-emerald-600" /><span><b class="block text-navy-800">Lokasi</b>{{ $activity->place_label }}@if($activity->village)<br><span class="text-slate-500">Kec. {{ $activity->village->district }}</span>@endif</span></p>
            @endif
            <p class="flex gap-3"><x-ui-icon name="photo" class="h-5 w-5 shrink-0 text-emerald-600" /><span><b class="block text-navy-800">Foto</b>{{ count($activity->photos ?? []) }} foto</span></p>
        </aside>
    </div>

    <div class="mt-10">
        @include('partials.gallery', ['photos' => $activity->photo_urls, 'title' => $activity->title])
    </div>
</article>

@if ($others->isNotEmpty())
<section class="pb-10">
    <div class="container-page max-w-5xl">
        <h2 class="text-2xl font-bold">Kegiatan lainnya</h2>
        <div class="mt-6 grid gap-3 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($others as $o)<x-activity-card :activity="$o" />@endforeach
        </div>
    </div>
</section>
@endif
@endsection
