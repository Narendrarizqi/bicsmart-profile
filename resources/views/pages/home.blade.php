@extends('layouts.app')

@section('content')
{{-- ============ HERO ============ --}}
<section class="bg-white">
    <div class="container-page grid items-center gap-8 py-10 sm:py-14 lg:grid-cols-12 lg:py-20">
        <div class="lg:col-span-7">
            <span class="eyebrow"><x-ui-icon name="sparkles" class="h-3.5 w-3.5" /> Hilirisasi Riset SINERGI · Kemdiktisaintek &amp; LPDP</span>
            <h1 class="mt-5 text-4xl font-extrabold leading-[1.1] sm:text-5xl lg:text-6xl">
                Bersama Wujudkan <span class="text-emerald-700">Banyumas Bebas DBD 2030</span> Melalui Inovasi Wolbachia
            </h1>
            <p class="mt-5 max-w-2xl text-lg leading-relaxed text-slate-600">
                BiC-SMART adalah program riset Universitas Muhammadiyah Purwokerto bersama Dinas Kesehatan Kabupaten Banyumas untuk menyiapkan warga, memantau nyamuk, dan memodelkan risiko demam berdarah di 12 desa mitra.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('edukasi') }}" class="btn-primary text-base">Kenali Nyamuk Wolbachia <x-ui-icon name="arrow-right" class="h-4 w-4" /></a>
                <a href="{{ route('dokumentasi') }}" class="btn-ghost text-base"><x-ui-icon name="photo" class="h-4 w-4" /> Lihat Kegiatan</a>
            </div>
        </div>

        {{-- Maskot melayang + balon dialog dinamis --}}
        <div class="relative mx-auto w-full max-w-sm lg:col-span-5 lg:max-w-none"
             x-data="{ i: 0, lines: ['Halo, Sobat Banyumas! 👋', 'Yuk, cegah DBD bersama!', 'Wolbachia itu alami & aman lho!', 'Jangan lupa 3M Plus, ya!'] }"
             x-init="setInterval(() => i = (i + 1) % lines.length, 3500)">
            <div class="absolute inset-x-6 bottom-6 top-10 rounded-[2.5rem] bg-navy-800"></div>
            <div class="relative">
                <div class="absolute -top-2 left-0 z-10 sm:left-2" aria-live="polite">
                    <div class="relative rounded-2xl rounded-bl-sm bg-white px-4 py-2.5 font-display text-sm font-bold text-navy-800 shadow-bento-hover ring-1 ring-cyan-200 sm:text-base">
                        <template x-for="(line, idx) in lines" :key="idx">
                            <span x-show="i === idx" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0 translate-y-1" x-text="line"></span>
                        </template>
                        <noscript>Halo, Sobat Banyumas! 👋</noscript>
                    </div>
                </div>
                <img src="{{ asset('images/mascot-pantau-jentik.webp') }}?v=2" alt="Maskot Pantau Jentik, nyamuk Aedes bergaris yang tersenyum dan mengacungkan dua jempol"
                     class="relative mx-auto w-[78%] animate-float" width="800" height="879" fetchpriority="high">
            </div>
        </div>
    </div>
</section>

{{-- ============ TRUST BADGES ============ --}}
<section class="border-y border-navy-100 bg-white">
    <div class="container-page grid gap-4 py-6 md:grid-cols-3">
        <div class="flex items-center gap-3"><span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-navy-50 text-navy-800"><x-ui-icon name="academic-cap" /></span><p class="text-sm"><b class="block text-navy-800">Hibah Riset Strategis SINERGI</b>Kemdiktisaintek &amp; LPDP 2024–2026</p></div>
        <div class="flex items-center gap-3"><span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-700"><x-ui-icon name="shield-check" /></span><p class="text-sm"><b class="block text-navy-800">Lolos Kaji Etik</b>KEP LPPM Universitas Jenderal Soedirman</p></div>
        <div class="flex items-center gap-3"><span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-cyan-50 text-cyan-700"><x-ui-icon name="users" /></span><p class="text-sm"><b class="block text-navy-800">Kolaborasi Resmi</b>UMP &amp; Dinas Kesehatan Kab. Banyumas</p></div>
    </div>
</section>

{{-- ============ BENTO: PILAR PROGRAM ============ --}}
<section class="section">
    <div class="container-page">
        <div class="max-w-2xl">
            <span class="eyebrow">Pilar Program</span>
            <h2 class="section-title mt-3">Sains yang dekat dengan warga</h2>
            <p class="section-lead">Tiga pilar kerja BiC-SMART memastikan inovasi Wolbachia diterima, terpantau, dan terukur dampaknya.</p>
        </div>

        <div class="mt-10 grid auto-rows-[minmax(11rem,auto)] gap-4 md:grid-cols-6 lg:grid-cols-12">
            <a href="{{ route('tentang') }}#wp1" class="bento bento-hover group md:col-span-3 lg:col-span-5 lg:row-span-2">
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-navy-800 text-white"><x-ui-icon name="users" class="h-6 w-6" /></span>
                <p class="mt-5 font-display text-xs font-bold uppercase tracking-wider text-emerald-700">Work Package 1</p>
                <h3 class="mt-1 text-2xl font-bold">Kesiapan Sosial Warga</h3>
                <p class="mt-3 text-slate-600">Survei baseline kepada 2.400 kepala keluarga di 12 desa oleh 120 enumerator gabungan mahasiswa UMP dan kader kesehatan, dengan audit integritas data berlapis.</p>
                <div class="mt-6 grid grid-cols-3 gap-2 text-center">
                    <div class="rounded-2xl bg-navy-50 p-3"><p class="font-display text-xl font-extrabold text-navy-800">2.400</p><p class="text-xs text-slate-500">KK</p></div>
                    <div class="rounded-2xl bg-navy-50 p-3"><p class="font-display text-xl font-extrabold text-navy-800">120</p><p class="text-xs text-slate-500">Enumerator</p></div>
                    <div class="rounded-2xl bg-navy-50 p-3"><p class="font-display text-xl font-extrabold text-navy-800">12</p><p class="text-xs text-slate-500">Desa</p></div>
                </div>
            </a>
            <a href="{{ route('tentang') }}#wp3" class="bento bento-hover group md:col-span-3 lg:col-span-4">
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500 text-white"><x-ui-icon name="beaker" class="h-6 w-6" /></span>
                <p class="mt-5 font-display text-xs font-bold uppercase tracking-wider text-emerald-700">WP1.5 &amp; WP3</p>
                <h3 class="mt-1 text-xl font-bold">Surveilans Entomologi Ovitrap</h3>
                <p class="mt-2 text-sm text-slate-600">600 ember ovitrap ber-QR (300 dalam, 300 luar rumah) dipantau mingguan selama 12 minggu.</p>
            </a>
            <div class="bento-navy relative overflow-hidden md:col-span-6 lg:col-span-3 lg:row-span-2">
                <p class="font-display text-xs font-bold uppercase tracking-wider text-emerald-300">Target Nasional</p>
                <p class="mt-2 font-display text-3xl font-extrabold leading-tight text-white">Zero Death by Dengue <span class="text-emerald-400">2030</span></p>
                <p class="mt-3 text-sm text-navy-200">Tidak ada lagi kematian akibat demam berdarah di Banyumas.</p>
                <img src="{{ asset('images/mascot-avatar.webp') }}?v=2" alt="" class="absolute bottom-0 right-0 h-36 w-auto object-contain object-bottom opacity-95" loading="lazy" width="120" height="155">
            </div>
            <a href="{{ route('tentang') }}#smce" class="bento bento-hover group md:col-span-3 lg:col-span-4">
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-500 text-white"><x-ui-icon name="chart" class="h-6 w-6" /></span>
                <p class="mt-5 font-display text-xs font-bold uppercase tracking-wider text-emerald-700">Modeling</p>
                <h3 class="mt-1 text-xl font-bold">Pemodelan Spasial &amp; EWS</h3>
                <p class="mt-2 text-sm text-slate-600">Pemetaan zona rentan DBD (SMCE) dan sistem peringatan dini berbasis lingkungan, cuaca, dan kepadatan jentik.</p>
            </a>
        </div>
    </div>
</section>

{{-- ============ KENALI NYAMUK BER-WOLBACHIA (interaktif) ============ --}}
<section class="section bg-white" x-data="{ tab: 'wolbachia' }">
    <div class="container-page grid items-center gap-10 lg:grid-cols-2">
        <div>
            <span class="eyebrow">Edukasi Interaktif</span>
            <h2 class="section-title mt-3">Kenali Nyamuk Ber-Wolbachia</h2>
            <p class="section-lead">Ketuk untuk membandingkan nyamuk <i>Aedes aegypti</i> biasa dengan nyamuk yang membawa bakteri alami Wolbachia.</p>
            <div class="mt-6 inline-flex rounded-full bg-slate-100 p-1" role="tablist">
                <button type="button" role="tab" :aria-selected="tab === 'biasa'" @click="tab = 'biasa'" class="rounded-full px-5 py-2.5 text-sm font-semibold transition" :class="tab === 'biasa' ? 'bg-white text-navy-800 shadow' : 'text-slate-500'">Aedes Biasa</button>
                <button type="button" role="tab" :aria-selected="tab === 'wolbachia'" @click="tab = 'wolbachia'" class="rounded-full px-5 py-2.5 text-sm font-semibold transition" :class="tab === 'wolbachia' ? 'bg-emerald-500 text-white shadow' : 'text-slate-500'">Ber-Wolbachia</button>
            </div>
        </div>
        <div class="relative grid min-h-[20rem]">
            @php
                $compare = [
                    'biasa' => ['ring-amber-200 bg-amber-50/60', 'text-amber-600', 'x-circle', 'Nyamuk Aedes aegypti biasa', [
                        'Dapat membawa virus dengue setelah menggigit orang yang sakit DBD.',
                        'Menularkan virus DBD, Zika, dan Chikungunya ke manusia lewat gigitan.',
                        'Berkembang biak di genangan air bersih di sekitar rumah.',
                    ]],
                    'wolbachia' => ['ring-emerald-200 bg-emerald-50/60', 'text-emerald-600', 'check-circle', 'Nyamuk Aedes aegypti ber-Wolbachia', [
                        'Membawa Wolbachia, bakteri alami yang ada di banyak jenis serangga.',
                        'Wolbachia menghambat virus dengue berkembang di tubuh nyamuk, sehingga sulit menular ke manusia.',
                        'Aman bagi manusia, hewan, dan lingkungan, serta bukan rekayasa genetika.',
                        'Melengkapi, bukan menggantikan, gerakan 3M Plus dan PSN.',
                    ]],
                ];
            @endphp
            @foreach ($compare as $key => [$box, $iconColor, $icon, $title, $points])
                <div
                    class="bento col-start-1 row-start-1 ring-2 transition-opacity duration-200 {{ $box }}"
                    :class="tab === '{{ $key }}' ? 'visible opacity-100' : 'invisible pointer-events-none opacity-0'"
                    :aria-hidden="tab !== '{{ $key }}'"
                    :inert="tab !== '{{ $key }}'"
                >
                    <h3 class="text-xl font-bold">{{ $title }}</h3>
                    <ul class="mt-4 space-y-3">
                        @foreach ($points as $p)
                            <li class="flex gap-3"><x-ui-icon :name="$icon" class="h-6 w-6 shrink-0 {{ $iconColor }}" /><span>{{ $p }}</span></li>
                        @endforeach
                    </ul>
                    <a href="{{ route('edukasi') }}" class="mt-6 inline-flex items-center gap-1 text-sm font-semibold text-emerald-700">Pelajari lebih lanjut <x-ui-icon name="arrow-right" class="h-4 w-4" /></a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ BERITA & DOKUMENTASI TERBARU ============ --}}
<section class="section">
    <div class="container-page grid gap-10 lg:grid-cols-12">
        <div class="lg:col-span-7">
            <div class="flex items-end justify-between gap-4">
                <div><span class="eyebrow">Berita</span><h2 class="section-title mt-3">Kabar Terbaru</h2></div>
                <a href="{{ route('berita.index') }}" class="hidden text-sm font-semibold text-emerald-700 sm:inline-flex sm:items-center sm:gap-1">Semua berita <x-ui-icon name="arrow-right" class="h-4 w-4" /></a>
            </div>
            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                @forelse ($articles->take(3) as $i => $article)
                    <x-article-card :article="$article" :large="$i === 0" :class="$i === 0 ? 'sm:col-span-2' : ''" />
                @empty
                    <p class="bento text-slate-500 sm:col-span-2">Belum ada berita.</p>
                @endforelse
            </div>
        </div>
        <div class="lg:col-span-5">
            <div class="flex items-end justify-between gap-4">
                <div><span class="eyebrow">Dokumentasi Harian</span><h2 class="section-title mt-3">Di Lapangan</h2></div>
                <a href="{{ route('dokumentasi') }}" class="text-sm font-semibold text-emerald-700 inline-flex items-center gap-1">Semua <x-ui-icon name="arrow-right" class="h-4 w-4" /></a>
            </div>
            <div class="mt-6 space-y-3">
                @forelse ($activities as $activity)
                    <x-activity-card :activity="$activity" />
                @empty
                    <p class="bento text-slate-500">Belum ada catatan kegiatan.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- ============ KONSORSIUM ============ --}}
<section class="pb-6">
    <div class="container-page">
        <div class="bento text-center">
            <p class="font-display text-xs font-bold uppercase tracking-wider text-slate-500">Didukung oleh konsorsium</p>
            <ul class="mt-6 flex flex-wrap items-center justify-center gap-x-10 gap-y-6">
                @foreach (config('bicsmart.partners') as $p)
                    <li class="flex flex-col items-center gap-2">
                        <img src="{{ asset('images/logos/'.$p['logo'].'.webp') }}?v=2" alt="{{ $p['name'] }}" class="h-16 w-auto object-contain sm:h-20" loading="lazy" height="80" width="80">
                        <span class="text-xs font-semibold text-navy-700">{{ $p['short'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endsection
