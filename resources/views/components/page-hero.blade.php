@props(['eyebrow' => null, 'title', 'lead' => null])
<section class="border-b border-navy-100 bg-white">
    <div class="container-page py-12 sm:py-16">
        @if ($eyebrow)<span class="eyebrow">{{ $eyebrow }}</span>@endif
        <h1 class="mt-4 max-w-3xl text-3xl font-extrabold leading-tight sm:text-5xl">{{ $title }}</h1>
        @if ($lead)<p class="section-lead">{{ $lead }}</p>@endif
        {{ $slot }}
    </div>
</section>
