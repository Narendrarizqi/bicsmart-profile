@extends('layouts.app')
@section('title', 'Dokumentasi Kegiatan Harian')
@section('description', 'Catatan dan foto kegiatan harian tim BiC-SMART di 12 desa mitra Kabupaten Banyumas.')

@section('content')
<x-page-hero eyebrow="Dokumentasi Harian" title="Catatan kegiatan di lapangan"
    lead="Rekam jejak kegiatan tim BiC-SMART dari hari ke hari: pelatihan, survei warga, pemantauan ovitrap, sosialisasi, hingga rapat koordinasi." />

<section class="section">
    <div class="container-page grid gap-8 lg:grid-cols-12">
        <aside class="lg:col-span-3">
            <form method="get" class="bento space-y-4 lg:sticky lg:top-24" x-data @change="$el.submit()">
                <p class="font-display text-sm font-bold uppercase tracking-wider text-navy-800">Saring</p>
                <div>
                    <label for="kategori" class="text-sm font-semibold text-slate-600">Kategori</label>
                    <select id="kategori" name="kategori" class="input mt-1">
                        <option value="">Semua kategori</option>
                        @foreach (\App\Models\Activity::CATEGORIES as $k => $l)<option value="{{ $k }}" @selected($filters['category'] === $k)>{{ $l }}</option>@endforeach
                    </select>
                </div>
                <div>
                    <label for="desa" class="text-sm font-semibold text-slate-600">Desa</label>
                    <select id="desa" name="desa" class="input mt-1">
                        <option value="">Semua desa</option>
                        @foreach ($villages as $v)<option value="{{ $v->slug }}" @selected($filters['village'] === $v->slug)>{{ $v->name }}</option>@endforeach
                    </select>
                </div>
                <div>
                    <label for="bulan" class="text-sm font-semibold text-slate-600">Bulan</label>
                    <select id="bulan" name="bulan" class="input mt-1">
                        <option value="">Semua bulan</option>
                        @foreach ($months as $m)<option value="{{ $m }}" @selected($filters['month'] === $m)>{{ \Carbon\Carbon::createFromFormat('Y-m', $m)->translatedFormat('F Y') }}</option>@endforeach
                    </select>
                </div>
                <noscript><button class="btn-navy w-full">Terapkan</button></noscript>
                @if (array_filter($filters))<a href="{{ route('dokumentasi') }}" class="block text-center text-sm font-semibold text-emerald-700">Hapus filter</a>@endif
            </form>
        </aside>

        <div class="lg:col-span-9">
            @forelse ($grouped as $month => $items)
                <div class="relative mb-10 pl-6 before:absolute before:bottom-0 before:left-[7px] before:top-2 before:w-0.5 before:bg-navy-100">
                    <h2 class="relative text-xl font-bold"><span class="absolute -left-6 top-1.5 h-4 w-4 rounded-full bg-emerald-500 ring-4 ring-emerald-100"></span>{{ $month }}</h2>
                    <div class="mt-4 grid gap-3 xl:grid-cols-2">
                        @foreach ($items as $activity)<x-activity-card :activity="$activity" />@endforeach
                    </div>
                </div>
            @empty
                <div class="bento text-center">
                    <img src="{{ asset('images/mascot-avatar.webp') }}" alt="" class="mx-auto h-24 w-auto" loading="lazy">
                    <p class="mt-3 font-semibold text-navy-800">Belum ada catatan kegiatan untuk filter ini.</p>
                </div>
            @endforelse
            <div>{{ $activities->links() }}</div>
        </div>
    </div>
</section>
@endsection
