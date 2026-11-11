@extends('layouts.app')
@section('title', 'Edukasi Wolbachia')
@section('description', 'Apa itu Wolbachia, bagaimana cara kerjanya mencegah DBD, bukti ilmiahnya, dan jawaban atas pertanyaan yang sering diajukan warga.')

@push('jsonld')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => $faqs->flatten()->map(fn ($f) => ['@type' => 'Question', 'name' => $f->question, 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f->answer]])->values(),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('content')
<x-page-hero eyebrow="Edukasi Sains Warga" title="Mengenal Wolbachia: sahabat alami melawan DBD"
    lead="Penjelasan sederhana tentang cara bakteri alami Wolbachia membantu menurunkan penularan demam berdarah dengue." />

{{-- Apa itu Wolbachia --}}
<section class="section">
    <div class="container-page grid gap-4 lg:grid-cols-12">
        <div class="bento lg:col-span-8">
            <h2 class="text-2xl font-bold">Apa itu Wolbachia?</h2>
            <div class="prose prose-slate mt-4 max-w-none prose-strong:text-navy-800">
                <p><strong>Wolbachia</strong> adalah bakteri alami yang hidup di dalam sel sekitar separuh jenis serangga di dunia, misalnya kupu-kupu, lebah, capung, dan lalat buah. Bakteri ini sudah ada di alam sejak lama dan tidak berbahaya bagi manusia.</p>
                <p>Secara alami, nyamuk <em>Aedes aegypti</em> (penular DBD) tidak memiliki Wolbachia. Para peneliti kemudian “menitipkan” Wolbachia ke dalam nyamuk <em>Aedes aegypti</em>. Ternyata, Wolbachia <strong>menghambat perkembangan virus dengue</strong> di dalam tubuh nyamuk, sehingga virus sulit menular ke manusia saat nyamuk menggigit.</p>
            </div>
        </div>
        <div class="grid gap-4 lg:col-span-4">
            @foreach ([['shield-check', 'Aman', 'Tidak dapat hidup di tubuh manusia maupun hewan.'], ['heart', 'Alami', 'Bukan rekayasa genetika. Gen nyamuk tidak diubah.'], ['globe', 'Ramah lingkungan', 'Tidak memakai bahan kimia dan tidak memusnahkan serangga.']] as [$icon, $t, $d])
                <div class="bento flex items-start gap-4 p-5">
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-200"><x-ui-icon :name="$icon" /></span>
                    <div><h3 class="font-bold">{{ $t }}</h3><p class="text-sm text-slate-600">{{ $d }}</p></div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Cara kerja --}}
<section class="section bg-white">
    <div class="container-page">
        <span class="eyebrow">Cara Kerja</span>
        <h2 class="section-title mt-3">Bagaimana Wolbachia melindungi warga?</h2>
        <ol class="mt-10 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            @foreach ([
                ['Dititipkan', 'Wolbachia dimasukkan ke nyamuk Aedes aegypti di laboratorium.'],
                ['Dilepaskan', 'Telur atau nyamuk ber-Wolbachia ditempatkan di lingkungan warga secara bertahap.'],
                ['Diturunkan', 'Nyamuk ber-Wolbachia kawin dengan nyamuk setempat dan menurunkan Wolbachia ke keturunannya.'],
                ['Terlindungi', 'Lama-kelamaan sebagian besar nyamuk membawa Wolbachia, sehingga penularan dengue menurun.'],
            ] as $i => [$t, $d])
                <li class="bento relative pt-10">
                    <span class="absolute -top-0 left-6 -translate-y-1/2 rounded-full bg-navy-800 px-3 py-1 font-display text-sm font-extrabold text-white shadow">{{ $i + 1 }}</span>
                    <h3 class="text-lg font-bold">{{ $t }}</h3>
                    <p class="mt-2 text-sm text-slate-600">{{ $d }}</p>
                </li>
            @endforeach
        </ol>
        <p class="mt-6 rounded-2xl bg-amber-50 p-4 text-sm text-amber-900 ring-1 ring-amber-200">
            <b>Penting:</b> Wolbachia <u>melengkapi</u>, bukan menggantikan, gerakan <b>3M Plus</b> (Menguras, Menutup, Mendaur ulang, plus mencegah gigitan nyamuk) dan Pemberantasan Sarang Nyamuk (PSN).
        </p>
    </div>
</section>

{{-- Bukti ilmiah --}}
<section class="section">
    <div class="container-page grid gap-4 lg:grid-cols-3">
        <div class="lg:col-span-1">
            <span class="eyebrow">Bukti Ilmiah</span>
            <h2 class="section-title mt-3">Sudah teruji di Indonesia</h2>
            <p class="mt-3 text-slate-600">Uji acak terkontrol di Kota Yogyakarta membuktikan penurunan kasus dengue yang signifikan di wilayah yang menerapkan Wolbachia.</p>
        </div>
        <div class="bento-navy text-center">
            <p class="font-display text-6xl font-extrabold text-emerald-400">77%</p>
            <p class="mt-2 font-semibold text-white">penurunan kasus dengue</p>
            <p class="mt-1 text-sm text-navy-200">di wilayah ber-Wolbachia dibandingkan wilayah pembanding</p>
        </div>
        <div class="bento-navy text-center">
            <p class="font-display text-6xl font-extrabold text-cyan-400">86%</p>
            <p class="mt-2 font-semibold text-white">penurunan rawat inap</p>
            <p class="mt-1 text-sm text-navy-200">akibat dengue di wilayah ber-Wolbachia</p>
        </div>
        <p class="text-xs text-slate-500 lg:col-span-3 lg:text-right">
            Sumber: Utarini A, dkk. <i>Efficacy of Wolbachia-Infected Mosquito Deployments for the Control of Dengue.</i> New England Journal of Medicine, 2021;384:2177–86. Kementerian Kesehatan RI kemudian menerapkan teknologi ini di Semarang, Jakarta Barat, Bandung, Kupang, dan Bontang sejak 2023.
        </p>
    </div>
</section>

{{-- FAQ --}}
<section class="section bg-white scroll-mt-24" id="faq">
    <div class="container-page grid gap-10 lg:grid-cols-12">
        <div class="lg:col-span-4">
            <img src="{{ asset('images/mascot-pantau-jentik.webp') }}?v=2" alt="Maskot Pantau Jentik, nyamuk Aedes bergaris yang tersenyum dan mengacungkan dua jempol" class="mx-auto w-48 animate-float lg:w-64" loading="lazy" width="800" height="879">
            <h2 class="section-title mt-6 text-center lg:text-left">Tanya Pantau Jentik</h2>
            <p class="mt-3 text-center text-slate-600 lg:text-left">Pertanyaan yang paling sering diajukan warga. Belum menemukan jawabannya? <a href="{{ route('kontak') }}" class="font-semibold text-emerald-700 underline">Hubungi kami</a>.</p>
        </div>
        <div class="space-y-8 lg:col-span-8" x-data="{ open: null }">
            @foreach ($faqs as $cat => $items)
                <div>
                    <h3 class="font-display text-sm font-bold uppercase tracking-wider text-emerald-700">{{ \App\Models\Faq::CATEGORIES[$cat] ?? $cat }}</h3>
                    <div class="mt-3 space-y-2">
                        @foreach ($items as $faq)
                            <div class="rounded-2xl bg-slate-50 ring-1 ring-navy-100">
                                <button type="button" class="flex w-full items-center gap-3 px-5 py-4 text-left font-semibold text-navy-800" @click="open = open === {{ $faq->id }} ? null : {{ $faq->id }}" :aria-expanded="open === {{ $faq->id }}">
                                    <span class="flex-1">{{ $faq->question }}</span>
                                    <x-ui-icon name="chevron-down" class="h-5 w-5 shrink-0 text-slate-400 transition" ::class="open === {{ $faq->id }} && 'rotate-180 text-emerald-600'" />
                                </button>
                                <div x-show="open === {{ $faq->id }}" x-collapse x-cloak class="px-5 pb-5 leading-relaxed text-slate-600">{{ $faq->answer }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
