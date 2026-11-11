@extends('layouts.app')
@section('title', 'Tentang Program')
@section('description', 'Latar belakang, pilar kerja, konsorsium, dan tim peneliti program BiC-SMART Universitas Muhammadiyah Purwokerto & Dinkes Banyumas.')

@section('content')
<x-page-hero eyebrow="Tentang BiC-SMART" title="Riset strategis untuk Banyumas bebas kematian akibat DBD"
    lead="Bio-Control Strategy, Modeling & Adaptive Readiness Technologies: program hilirisasi riset strategis nasional yang didanai Kemdiktisaintek dan LPDP." />

<section class="section">
    <div class="container-page grid gap-4 lg:grid-cols-12">
        <div class="bento lg:col-span-7">
            <h2 class="text-2xl font-bold">Latar Belakang</h2>
            <div class="prose prose-slate mt-4 max-w-none prose-strong:text-navy-800">
                <p>BiC-SMART dijalankan melalui kolaborasi <strong>Universitas Muhammadiyah Purwokerto (UMP)</strong> dan <strong>Dinas Kesehatan Kabupaten Banyumas</strong>, dengan pendanaan dari Kementerian Pendidikan Tinggi, Sains, dan Teknologi (Kemdiktisaintek) serta Lembaga Pengelola Dana Pendidikan (LPDP).</p>
                <p>Tujuannya mewujudkan visi <strong>Zero Death by Dengue 2030</strong> di Kabupaten Banyumas melalui pemanfaatan nyamuk <em>Aedes aegypti</em> ber-Wolbachia yang aman, alami, dan berkelanjutan. Agar inovasi sains ini berhasil di tengah masyarakat, program memastikan warga siap, nyamuk terpantau, dan risiko terpetakan.</p>
            </div>
        </div>
        <div class="bento-navy lg:col-span-5">
            <h2 class="text-2xl font-bold">Legalitas &amp; Etik</h2>
            <ul class="mt-5 space-y-4 text-sm">
                <li class="flex gap-3"><span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/10 text-emerald-300"><x-ui-icon name="academic-cap" /></span><span><b class="block text-white">Pendanaan</b>{{ config('bicsmart.legal.grant') }}</span></li>
                <li class="flex gap-3"><span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/10 text-emerald-300"><x-ui-icon name="shield-check" /></span><span><b class="block text-white">Kelaikan Etik</b>{{ config('bicsmart.legal.ethics') }}</span></li>
                <li class="flex gap-3"><span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/10 text-emerald-300"><x-ui-icon name="lock" /></span><span><b class="block text-white">Perlindungan Data</b>Identitas responden disamarkan (pseudonimisasi Salted SHA-256) sebelum dianalisis.</span></li>
            </ul>
        </div>
    </div>
</section>

<section class="section bg-white">
    <div class="container-page">
        <span class="eyebrow">Pilar Kerja</span>
        <h2 class="section-title mt-3">Work Package Program</h2>
        <div class="mt-10 grid gap-4 md:grid-cols-2">
            @php
                $wps = [
                    ['wp1', 'users', 'bg-navy-800', 'Work Package 1', 'Kesiapan Sosial Warga', 'Survei baseline kesiapan sosial kepada 2.400 kepala keluarga di 12 desa intervensi melalui KoBoToolbox, dilaksanakan oleh 120 enumerator gabungan mahasiswa UMP dan kader kesehatan.', ['Kuesioner digital 70 butir', 'Audit integritas data 4 tingkat', 'Informed consent setiap responden']],
                    ['wp3', 'beaker', 'bg-emerald-500', 'Work Package 1.5 & 3', 'Surveilans Entomologi Ovitrap', 'Penempatan dan pemantauan 600 ember ovitrap ber-QR (300 dalam rumah dan 300 luar rumah) selama 12 minggu di 12 desa mitra untuk melacak kepadatan telur dan jentik.', ['Stiker QR ganda per ember', 'Inspeksi mingguan oleh kader', 'Siklus pemantauan 12 minggu']],
                    ['smce', 'chart', 'bg-cyan-500', 'Modeling', 'Pemodelan Spasial & EWS', 'Pemodelan Spatial Multi-Criteria Evaluation (SMCE) untuk memetakan zona rentan DBD dan integrasi sistem peringatan dini (Early Warning System).', ['Indikator lingkungan & cuaca', 'Data kepadatan jentik', 'Peta zona kerentanan']],
                    ['data', 'lock', 'bg-slate-700', 'Tata Kelola', 'SOP & Perlindungan Data', 'Komitmen etika riset dan perlindungan data pribadi subjek penelitian sesuai kelaikan etik yang diperoleh.', ['Pseudonimisasi Salted SHA-256', 'Data publik hanya agregat desa', 'Tanpa titik GPS rumah warga']],
                ];
            @endphp
            @foreach ($wps as [$id, $icon, $bg, $label, $title, $desc, $points])
                <article id="{{ $id }}" class="bento scroll-mt-28">
                    <div class="flex items-start gap-4">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl {{ $bg }} text-white"><x-ui-icon :name="$icon" class="h-6 w-6" /></span>
                        <div>
                            <p class="font-display text-xs font-bold uppercase tracking-wider text-emerald-700">{{ $label }}</p>
                            <h3 class="text-xl font-bold">{{ $title }}</h3>
                        </div>
                    </div>
                    <p class="mt-4 text-slate-600">{{ $desc }}</p>
                    <ul class="mt-4 flex flex-wrap gap-2">
                        @foreach ($points as $pt)
                            <li class="badge bg-slate-50 text-slate-700 ring-slate-200"><x-ui-icon name="check" class="mr-1 h-3.5 w-3.5 text-emerald-600" />{{ $pt }}</li>
                        @endforeach
                    </ul>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section" id="tim">
    <div class="container-page">
        <span class="eyebrow">Tim</span>
        <h2 class="section-title mt-3">Tim Peneliti</h2>
        <p class="section-lead">Dosen dan peneliti Universitas Muhammadiyah Purwokerto lintas bidang keilmuan.</p>
        <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($researchers as $m)
                @include('partials.team-card', ['m' => $m, 'lead' => $loop->first])
            @endforeach
        </div>

        @if ($staff->isNotEmpty())
            <h3 class="mt-14 text-2xl font-bold">Tim Pelaksana</h3>
            <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
                @foreach ($staff as $m)
                    @include('partials.team-card', ['m' => $m, 'compact' => true])
                @endforeach
            </div>
        @endif
    </div>
</section>

<section class="pb-6">
    <div class="container-page">
        <div class="bento">
            <h2 class="text-center text-2xl font-bold">Konsorsium Mitra</h2>
            <ul class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
                @foreach (config('bicsmart.partners') as $p)
                    <li class="flex flex-col items-center rounded-2xl bg-slate-50 p-4 text-center ring-1 ring-navy-100">
                        <img src="{{ asset('images/logos/'.$p['logo'].'.webp') }}?v=2" alt="{{ $p['name'] }}" class="h-20 w-auto object-contain" loading="lazy" height="80" width="80">
                        <p class="mt-3 text-sm font-bold text-navy-800">{{ $p['short'] }}</p>
                        <p class="text-xs text-slate-500">{{ $p['role'] }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endsection
