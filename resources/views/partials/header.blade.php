@php
    $menu = [
        ['home', 'Beranda'],
        ['tentang', 'Tentang'],
        ['edukasi', 'Edukasi Wolbachia'],
        ['dokumentasi', 'Dokumentasi'],
        ['berita.index', 'Berita'],
        ['peta-sebaran', 'Peta Sebaran'],
        ['kontak', 'Kontak'],
    ];
    $isActive = fn ($r) => request()->routeIs($r) || request()->routeIs($r.'.*') || ($r === 'berita.index' && request()->routeIs('berita.*')) || ($r === 'dokumentasi' && request()->routeIs('dokumentasi.*'));
@endphp
<header x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = window.scrollY > 24" class="sticky top-0 z-40">
    {{-- Baris logo 6 mitra konsorsium --}}
    <div class="border-b border-navy-100 bg-white" x-show="!scrolled" x-transition.opacity>
        <div class="container-page flex items-center justify-between gap-4 py-2">
            <ul class="flex items-center gap-2.5 sm:gap-4" aria-label="Mitra konsorsium">
                @foreach (config('bicsmart.partners') as $p)
                    <li>
                        <img src="{{ asset('images/logos/'.$p['logo'].'.webp') }}?v=2" alt="{{ $p['name'] }}" title="{{ $p['name'] }}"
                             class="h-7 w-auto object-contain sm:h-9" width="40" height="36" loading="eager" decoding="async">
                    </li>
                @endforeach
            </ul>
            <p class="hidden text-right text-xs font-medium leading-tight text-navy-600 md:block">
                Program Hilirisasi Riset Strategis SINERGI<br><span class="text-slate-500">Kemdiktisaintek &amp; LPDP</span>
            </p>
        </div>
    </div>

    {{-- Navbar utama --}}
    <nav class="border-b border-navy-100/70 bg-white/85 backdrop-blur-md transition" :class="scrolled && 'shadow-bento'" aria-label="Navigasi utama">
        <div class="container-page flex h-16 items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2.5" aria-label="BiC-SMART — Beranda">
                <img src="{{ asset('images/icon-512.png') }}?v=2" alt="" class="h-11 w-11 object-contain" width="44" height="44">
                <span class="hidden leading-tight sm:block">
                    <span class="block font-display text-sm font-extrabold text-navy-800">BiC-<span class="text-brand-leaf">SMART</span></span>
                    <span class="block text-[11px] font-medium text-slate-500">Zero Death by Dengue 2030</span>
                </span>
            </a>

            <ul class="hidden items-center gap-1 lg:flex">
                @foreach ($menu as [$route, $label])
                    <li><a href="{{ route($route) }}" @class(['nav-link', 'nav-link-active' => $isActive($route)]) @if($isActive($route)) aria-current="page" @endif>{{ $label }}</a></li>
                @endforeach
            </ul>

            <div class="flex items-center gap-2">
                <a href="{{ route('dokumentasi') }}" class="btn-primary hidden sm:inline-flex">
                    <x-ui-icon name="photo" class="h-4 w-4" /> Kegiatan Terbaru
                </a>
                <button type="button" class="inline-flex h-11 w-11 items-center justify-center rounded-full text-navy-800 ring-1 ring-navy-200 lg:hidden"
                        @click="open = !open" :aria-expanded="open" aria-controls="mobile-menu" aria-label="Buka menu">
                    <x-ui-icon name="menu" class="h-6 w-6" x-show="!open" />
                    <x-ui-icon name="x" class="h-6 w-6" x-show="open" x-cloak />
                </button>
            </div>
        </div>

        {{-- Menu mobile --}}
        <div id="mobile-menu" x-show="open" x-cloak x-transition @click.outside="open = false" class="border-t border-navy-100 bg-white lg:hidden">
            <ul class="container-page grid gap-1 py-3">
                @foreach ($menu as [$route, $label])
                    <li><a href="{{ route($route) }}" @class(['block rounded-xl px-4 py-3 font-semibold', 'bg-navy-800 text-white' => $isActive($route), 'text-navy-800 hover:bg-navy-50' => ! $isActive($route)])>{{ $label }}</a></li>
                @endforeach
                <li class="pt-2"><a href="{{ route('dokumentasi') }}" class="btn-primary w-full">Kegiatan Terbaru</a></li>
            </ul>
        </div>
    </nav>
</header>
