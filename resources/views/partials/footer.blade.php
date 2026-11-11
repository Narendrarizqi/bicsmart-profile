<footer class="mt-16 bg-navy-900 text-navy-100">
    <div class="container-page grid gap-10 py-14 md:grid-cols-12">
        <div class="md:col-span-5">
            <div class="inline-flex rounded-2xl bg-white p-3">
                <img src="{{ asset('images/brand-roadmap-2030.webp') }}" alt="BiC-SMART menuju Zero Death by Dengue 2030" class="h-14 w-auto" width="256" height="56" loading="lazy">
            </div>
            <p class="mt-5 max-w-md text-sm leading-relaxed text-navy-200">
                {{ config('bicsmart.long_name') }}. Program riset Universitas Muhammadiyah Purwokerto bersama Dinas Kesehatan Kabupaten Banyumas.
            </p>
            <ul class="mt-5 space-y-2 text-xs text-navy-300">
                <li class="flex gap-2"><x-ui-icon name="academic-cap" class="h-4 w-4 shrink-0 text-emerald-400" /> {{ config('bicsmart.legal.grant') }}</li>
                <li class="flex gap-2"><x-ui-icon name="shield-check" class="h-4 w-4 shrink-0 text-emerald-400" /> Kelaikan etik: {{ config('bicsmart.legal.ethics') }}</li>
            </ul>
        </div>

        <div class="md:col-span-3">
            <h2 class="font-display text-sm font-bold uppercase tracking-wider text-white">Jelajahi</h2>
            <ul class="mt-4 grid grid-cols-2 gap-2 text-sm md:grid-cols-1">
                <li><a class="hover:text-emerald-300" href="{{ route('tentang') }}">Tentang Program</a></li>
                <li><a class="hover:text-emerald-300" href="{{ route('edukasi') }}">Edukasi Wolbachia</a></li>
                <li><a class="hover:text-emerald-300" href="{{ route('dokumentasi') }}">Dokumentasi Harian</a></li>
                <li><a class="hover:text-emerald-300" href="{{ route('berita.index') }}">Berita</a></li>
                <li><a class="hover:text-emerald-300" href="{{ route('peta-sebaran') }}">12 Desa Mitra</a></li>
                <li><a class="hover:text-emerald-300" href="{{ route('kontak') }}">Kontak</a></li>
            </ul>
        </div>

        <div class="md:col-span-4">
            <h2 class="font-display text-sm font-bold uppercase tracking-wider text-white">Sekretariat</h2>
            <address class="mt-4 space-y-3 text-sm not-italic">
                <p class="flex gap-2"><x-ui-icon name="map-pin" class="mt-0.5 h-4 w-4 shrink-0 text-emerald-400" /><span>{{ config('bicsmart.contact.office') }}<br>{{ config('bicsmart.contact.address') }}</span></p>
                @foreach (config('bicsmart.contact.emails') as $email)
                    <p class="flex gap-2"><x-ui-icon name="mail" class="h-4 w-4 shrink-0 text-emerald-400" /><a class="hover:text-emerald-300" href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to={{ urlencode($email) }}" target="_blank" rel="noopener noreferrer">{{ $email }}</a></p>
                @endforeach
            </address>
        </div>
    </div>
    <div class="border-t border-white/10">
        <div class="container-page flex flex-col gap-2 py-5 text-xs text-navy-300 sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; {{ now()->year }} BiC-SMART · Universitas Muhammadiyah Purwokerto &amp; Dinas Kesehatan Kabupaten Banyumas</p>
            <a href="{{ url('/admin') }}" class="hover:text-white" rel="nofollow">Masuk CMS</a>
        </div>
    </div>
</footer>
