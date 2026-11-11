@props(['activity'])
<article {{ $attributes->merge(['class' => 'bento bento-hover group p-0']) }}>
    <a href="{{ route('dokumentasi.show', $activity) }}" class="flex h-full gap-4 p-4 sm:p-5">
        <div class="relative h-20 w-20 shrink-0 overflow-hidden rounded-2xl bg-navy-50 sm:h-24 sm:w-24">
            @if ($activity->cover_url)
                <img src="{{ $activity->cover_url }}" alt="" class="h-full w-full object-cover" loading="lazy" decoding="async">
                @if (count($activity->photos ?? []) > 1)
                    <span class="absolute bottom-1 right-1 rounded-md bg-navy-900/75 px-1.5 text-[10px] font-semibold text-white">+{{ count($activity->photos) - 1 }}</span>
                @endif
            @else
                <div class="flex h-full flex-col items-center justify-center text-navy-800">
                    <span class="font-display text-2xl font-extrabold leading-none">{{ $activity->activity_date->format('d') }}</span>
                    <span class="text-xs font-semibold uppercase">{{ $activity->activity_date->translatedFormat('M') }}</span>
                </div>
            @endif
        </div>
        <div class="min-w-0 flex-1">
            <span class="badge {{ $activity->category_color }}">{{ $activity->category_label }}</span>
            <h3 class="mt-2 font-bold leading-snug text-navy-800 group-hover:text-emerald-700">{{ $activity->title }}</h3>
            <p class="mt-1 flex flex-wrap gap-x-3 gap-y-1 text-xs text-slate-500">
                <span class="inline-flex items-center gap-1"><x-ui-icon name="calendar" class="h-3.5 w-3.5" />{{ $activity->activity_date->translatedFormat('l, d F Y') }}</span>
                @if ($activity->place_label)
                    <span class="inline-flex items-center gap-1"><x-ui-icon name="map-pin" class="h-3.5 w-3.5" />{{ $activity->place_label }}</span>
                @endif
            </p>
        </div>
    </a>
</article>
