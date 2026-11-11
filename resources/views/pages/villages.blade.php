@extends('layouts.app')
@section('title', 'Peta Sebaran 12 Desa Mitra')
@section('description', 'Daftar 12 desa mitra program BiC-SMART di Kabupaten Banyumas, dikelompokkan per kecamatan.')

@section('content')
<x-page-hero eyebrow="Wilayah Program" title="12 Desa Mitra di Kabupaten Banyumas"
    lead="Program BiC-SMART berjalan di {{ $total }} desa yang tersebar di {{ $districts->count() }} kecamatan. Informasi yang ditampilkan bersifat agregat desa, tanpa data pribadi atau lokasi rumah warga." />

<section class="section">
    <div class="container-page space-y-6">
        <section class="bento overflow-hidden p-0" aria-labelledby="village-map-heading">
            <div class="flex flex-col gap-2 p-6 pb-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="font-display text-xs font-bold uppercase tracking-wider text-emerald-700">Peta interaktif</p>
                    <h2 id="village-map-heading" class="mt-1 text-xl font-bold">Batas wilayah desa mitra</h2>
                </div>
                <span class="badge w-fit bg-navy-50 text-navy-700 ring-navy-200">{{ $total }} desa</span>
            </div>
            <div
                id="village-map"
                class="village-map z-0 w-full bg-slate-100"
                data-geojson-url="{{ route('peta-sebaran.geojson') }}"
                role="region"
                aria-label="Peta batas wilayah 12 desa mitra BiC-SMART"
            ></div>
            <p id="village-map-status" class="min-h-12 px-6 py-3 text-sm text-slate-600" role="status" aria-live="polite">
                Memuat peta wilayah desa...
            </p>
        </section>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($districts as $district => $villages)
                <div @class(['bento', 'md:col-span-2 lg:col-span-1' => false])>
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="font-display text-xs font-bold uppercase tracking-wider text-slate-500">Kecamatan</p>
                            <h2 class="text-xl font-bold">{{ $district }}</h2>
                        </div>
                        <span class="badge bg-navy-50 text-navy-700 ring-navy-200">{{ $villages->count() }} desa</span>
                    </div>
                    <ul class="mt-5 space-y-2">
                        @foreach ($villages as $v)
                            <li>
                                <a href="{{ route('dokumentasi', ['desa' => $v->slug]) }}" class="group flex items-center gap-3 rounded-2xl bg-slate-50 p-3 ring-1 ring-navy-100 transition hover:bg-emerald-50 hover:ring-emerald-200">
                                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-navy-800 font-display text-xs font-extrabold tracking-wider text-white">{{ $v->code }}</span>
                                    <span class="flex-1">
                                        <span class="block font-bold text-navy-800">Desa {{ $v->name }}</span>
                                        <span class="text-xs text-slate-500">{{ $v->activities_count }} catatan dokumentasi</span>
                                    </span>
                                    <x-ui-icon name="chevron-right" class="h-5 w-5 text-slate-400 transition group-hover:translate-x-0.5 group-hover:text-emerald-600" />
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="bento mt-6 flex flex-col items-start gap-4 bg-emerald-50 sm:flex-row sm:items-center">
            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-emerald-600 shadow"><x-ui-icon name="lock" class="h-6 w-6" /></span>
            <p class="text-sm text-slate-700"><b class="text-navy-800">Privasi warga terjaga.</b> Website ini tidak menampilkan alamat, koordinat rumah, ataupun identitas responden. Data riset rinci hanya dapat diakses tim peneliti sesuai ketentuan kelaikan etik.</p>
        </div>
    </div>
</section>
@endsection
