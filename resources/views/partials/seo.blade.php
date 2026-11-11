@php
    $siteName = config('bicsmart.name');
    $pageTitle = trim($__env->yieldContent('title'));
    $fullTitle = $pageTitle ? "{$pageTitle} · {$siteName}" : "{$siteName} — ".config('bicsmart.target');
    $description = trim($__env->yieldContent('description')) ?: 'BiC-SMART: program riset UMP & Dinkes Banyumas untuk menyiapkan warga, memantau nyamuk, dan memodelkan risiko DBD menuju Zero Death by Dengue 2030 melalui inovasi Wolbachia.';
    $image = trim($__env->yieldContent('og_image')) ?: asset('images/brand-roadmap-2030.png');
@endphp
<title>{{ $fullTitle }}</title>
<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ url()->current() }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="id_ID">
<meta property="og:type" content="@yield('og_type', 'website')">
<meta property="og:title" content="{{ $fullTitle }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ $image }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="theme-color" content="#0A2864">
<link rel="icon" href="{{ asset('favicon.ico') }}?v=2" sizes="16x16 32x32 48x48">
<link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}?v=2" sizes="180x180">
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => ['ResearchProject', 'MedicalOrganization'],
            '@id' => url('/').'#org',
            'name' => 'BiC-SMART — '.config('bicsmart.long_name'),
            'alternateName' => 'BiC-SMART',
            'url' => url('/'),
            'logo' => asset('images/logos/logo-bicsmart-full.png'),
            'description' => $description,
            'email' => config('bicsmart.contact.emails.0'),
            'address' => ['@type' => 'PostalAddress', 'streetAddress' => 'Jl. KH. Ahmad Dahlan', 'addressLocality' => 'Kembaran, Banyumas', 'addressRegion' => 'Jawa Tengah', 'postalCode' => '53182', 'addressCountry' => 'ID'],
            'parentOrganization' => ['@type' => 'CollegeOrUniversity', 'name' => 'Universitas Muhammadiyah Purwokerto'],
            'funder' => [['@type' => 'GovernmentOrganization', 'name' => 'Kementerian Pendidikan Tinggi, Sains, dan Teknologi'], ['@type' => 'GovernmentOrganization', 'name' => 'Lembaga Pengelola Dana Pendidikan (LPDP)']],
            'areaServed' => ['@type' => 'AdministrativeArea', 'name' => 'Kabupaten Banyumas'],
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@stack('jsonld')
