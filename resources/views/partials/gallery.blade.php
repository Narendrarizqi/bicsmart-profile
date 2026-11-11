{{-- Galeri foto + lightbox. Variabel: $photos (array URL), $title --}}
@if (count($photos))
<div x-data="{ open: false, i: 0, photos: @js(array_values($photos)), next() { this.i = (this.i + 1) % this.photos.length }, prev() { this.i = (this.i - 1 + this.photos.length) % this.photos.length } }"
     @keydown.escape.window="open = false" @keydown.arrow-right.window="open && next()" @keydown.arrow-left.window="open && prev()">
    <div class="grid grid-cols-2 gap-2 sm:grid-cols-3">
        @foreach ($photos as $idx => $url)
            <button type="button" @click="i = {{ $idx }}; open = true" class="group relative aspect-[4/3] overflow-hidden rounded-2xl bg-slate-100 ring-1 ring-navy-100 {{ $idx === 0 && count($photos) > 2 ? 'col-span-2 row-span-2 aspect-auto sm:aspect-[4/3]' : '' }}" aria-label="Perbesar foto {{ $idx + 1 }}">
                <img src="{{ $url }}" alt="{{ $title }} — foto {{ $idx + 1 }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy" decoding="async">
            </button>
        @endforeach
    </div>
    <div x-show="open" x-cloak x-transition.opacity class="fixed inset-0 z-[60] flex items-center justify-center bg-navy-950/90 p-4" role="dialog" aria-modal="true" @click.self="open = false">
        <img :src="photos[i]" alt="" class="max-h-[85vh] max-w-full rounded-xl object-contain shadow-2xl">
        <button type="button" @click="open = false" class="absolute right-4 top-4 rounded-full bg-white/10 p-3 text-white hover:bg-white/20" aria-label="Tutup"><x-ui-icon name="x" class="h-6 w-6" /></button>
        <template x-if="photos.length > 1">
            <div>
                <button type="button" @click="prev()" class="absolute left-3 top-1/2 -translate-y-1/2 rounded-full bg-white/10 p-3 text-white hover:bg-white/20" aria-label="Sebelumnya"><x-ui-icon name="chevron-left" class="h-6 w-6" /></button>
                <button type="button" @click="next()" class="absolute right-3 top-1/2 -translate-y-1/2 rounded-full bg-white/10 p-3 text-white hover:bg-white/20" aria-label="Berikutnya"><x-ui-icon name="chevron-right" class="h-6 w-6" /></button>
                <p class="absolute bottom-4 left-1/2 -translate-x-1/2 rounded-full bg-white/10 px-3 py-1 text-sm text-white" x-text="(i + 1) + ' / ' + photos.length"></p>
            </div>
        </template>
    </div>
</div>
@endif
