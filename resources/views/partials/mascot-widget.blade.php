{{-- Widget FAQ melayang dengan maskot "Pantau Jentik". Isi FAQ dikelola di CMS. --}}
<div x-data="{ open: false, active: null, hint: true }" x-init="setTimeout(() => hint = false, 9000)" class="fixed bottom-4 right-4 z-50 flex flex-col items-end gap-3 sm:bottom-6 sm:right-6">
    <div x-show="open" x-cloak x-transition.origin.bottom.right @keydown.escape.window="open = false"
         class="w-[calc(100vw-2rem)] max-w-sm overflow-hidden rounded-bento bg-white shadow-bento-hover ring-1 ring-navy-100" role="dialog" aria-label="Tanya Pantau Jentik">
        <div class="flex items-center gap-3 bg-navy-800 px-5 py-4 text-white">
            <img src="{{ asset('images/mascot-avatar.webp') }}?v=2" alt="" class="h-12 w-auto object-contain object-bottom" width="40" height="52">
            <div class="flex-1">
                <p class="font-display font-bold">Tanya Pantau Jentik</p>
                <p class="text-xs text-navy-200">Pilih pertanyaan di bawah, ya!</p>
            </div>
            <button type="button" @click="open = false" class="rounded-full p-2 hover:bg-white/10" aria-label="Tutup"><x-ui-icon name="x" /></button>
        </div>
        <div class="max-h-[55vh] space-y-2 overflow-y-auto p-4">
            <div class="rounded-2xl rounded-tl-sm bg-cyan-50 p-3 text-sm text-navy-800 ring-1 ring-cyan-100">
                Halo, Sobat Banyumas! 👋 Aku <b>Pantau Jentik</b>. Ada yang ingin kamu ketahui tentang nyamuk Wolbachia?
            </div>
            @foreach ($widgetFaqs as $i => $faq)
                <div class="rounded-2xl ring-1 ring-navy-100">
                    <button type="button" @click="active = active === {{ $i }} ? null : {{ $i }}" :aria-expanded="active === {{ $i }}"
                            class="flex w-full items-start gap-2 px-3 py-2.5 text-left text-sm font-semibold text-navy-800 hover:bg-navy-50">
                        <span class="flex-1">{{ $faq->question }}</span>
                        <x-ui-icon name="chevron-down" class="mt-0.5 h-4 w-4 shrink-0 transition" ::class="active === {{ $i }} && 'rotate-180'" />
                    </button>
                    <div x-show="active === {{ $i }}" x-collapse x-cloak class="px-3 pb-3 text-sm leading-relaxed text-slate-600">{{ $faq->answer }}</div>
                </div>
            @endforeach
            <a href="{{ route('edukasi') }}#faq" class="mt-2 flex items-center justify-center gap-1 rounded-xl py-2 text-sm font-semibold text-emerald-700 hover:bg-emerald-50">
                Lihat semua pertanyaan <x-ui-icon name="arrow-right" class="h-4 w-4" />
            </a>
        </div>
    </div>

    <div class="flex items-end gap-2">
        <div x-show="hint && !open" x-transition x-cloak class="mb-3 hidden rounded-2xl rounded-br-sm bg-white px-4 py-2 text-sm font-semibold text-navy-800 shadow-bento ring-1 ring-navy-100 sm:block">
            Ada pertanyaan? Tanya aku! 💬
        </div>
        <button type="button" @click="open = !open; hint = false" :aria-expanded="open"
                class="group relative flex h-16 w-16 items-center justify-center rounded-full bg-white shadow-bento-hover ring-4 ring-emerald-400/70 transition hover:scale-105 sm:h-[4.5rem] sm:w-[4.5rem]"
                aria-label="Buka tanya-jawab dengan maskot Pantau Jentik">
            <img src="{{ asset('images/mascot-avatar.webp') }}?v=2" alt="" class="h-12 w-auto object-contain object-bottom group-hover:animate-float sm:h-14" width="44" height="56">
            <span class="absolute -right-0.5 -top-0.5 flex h-4 w-4"><span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span><span class="relative inline-flex h-4 w-4 rounded-full bg-emerald-500 ring-2 ring-white"></span></span>
        </button>
    </div>
</div>
