@props(['article', 'large' => false])
<article {{ $attributes->merge(['class' => 'bento bento-hover group flex flex-col overflow-hidden p-0']) }}>
    <a href="{{ route('berita.show', $article) }}" class="flex h-full flex-col">
        <div @class(['relative overflow-hidden bg-navy-800', 'aspect-[16/9]' => ! $large, 'aspect-[16/10] lg:aspect-auto lg:min-h-[18rem] lg:flex-1' => $large])>
            @if ($article->image_url)
                <img src="{{ $article->image_url }}" alt="" class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy" decoding="async">
            @else
                <img src="{{ asset('images/mascot-avatar.webp') }}?v=2" alt="" class="absolute bottom-0 right-4 h-4/5 w-auto opacity-90 transition duration-500 group-hover:-translate-y-1" loading="lazy">
                <x-ui-icon name="newspaper" class="absolute left-5 top-5 h-8 w-8 text-white/40" />
            @endif
        </div>
        <div class="flex flex-1 flex-col p-6">
            <div class="flex flex-wrap items-center gap-2 text-xs">
                <span class="badge bg-emerald-50 text-emerald-700 ring-emerald-200">{{ $article->category_label }}</span>
                <time class="text-slate-500" datetime="{{ $article->published_at->toDateString() }}">{{ $article->published_at->translatedFormat('d F Y') }}</time>
            </div>
            <h3 @class(['mt-3 font-bold leading-snug text-navy-800 group-hover:text-emerald-700', 'text-xl sm:text-2xl' => $large, 'text-lg' => ! $large])>{{ $article->title }}</h3>
            <p class="mt-2 line-clamp-3 text-sm text-slate-600">{{ $article->excerpt }}</p>
            <span class="mt-auto inline-flex items-center gap-1 pt-4 text-sm font-semibold text-emerald-700">Baca selengkapnya <x-ui-icon name="arrow-right" class="h-4 w-4 transition group-hover:translate-x-1" /></span>
        </div>
    </a>
</article>
