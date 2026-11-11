@php($compact = $compact ?? false)
<article @class(['bento flex gap-4', 'flex-col items-center text-center' => $compact, 'items-center' => ! $compact, 'ring-2 ring-emerald-300' => $lead ?? false])>
    @if ($m->photo_url)
        <img src="{{ $m->photo_url }}" alt="Foto {{ $m->name }}" @class(['shrink-0 rounded-full object-cover ring-4 ring-white shadow', 'h-20 w-20' => ! $compact, 'h-16 w-16' => $compact]) loading="lazy">
    @else
        <span @class(['flex shrink-0 items-center justify-center rounded-full bg-navy-800 font-display font-extrabold text-white', 'h-20 w-20 text-2xl' => ! $compact, 'h-16 w-16 text-xl' => $compact]) aria-hidden="true">{{ $m->initials }}</span>
    @endif
    <div class="min-w-0">
        <p @class(['font-display text-xs font-bold uppercase tracking-wider', 'text-emerald-700' => ! $compact, 'text-cyan-700' => $compact])>{{ $m->position }}</p>
        <h3 @class(['mt-1 font-bold leading-snug text-navy-800', 'text-base' => ! $compact, 'text-sm' => $compact])>{{ $m->name }}</h3>
        @if ($m->expertise)<p class="mt-1 text-sm text-slate-600">{{ $m->expertise }}</p>@endif
        @if ($m->bio && ! $compact)<p class="mt-2 text-sm text-slate-500">{{ $m->bio }}</p>@endif
    </div>
</article>
