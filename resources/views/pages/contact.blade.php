@extends('layouts.app')
@section('title', 'Kontak')
@section('description', 'Hubungi Sekretariat Program BiC-SMART di Gedung Riset Universitas Muhammadiyah Purwokerto.')

@section('content')
<x-page-hero eyebrow="Hubungi Kami" title="Sekretariat Program BiC-SMART"
    lead="Punya pertanyaan, masukan, atau ingin bekerja sama? Tim kami siap membantu." />

<section class="section">
    <div class="container-page grid gap-4 lg:grid-cols-3">
        <div class="bento lg:col-span-2">
            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-navy-800 text-white"><x-ui-icon name="map-pin" class="h-6 w-6" /></span>
                    <h2 class="mt-4 text-lg font-bold">Alamat</h2>
                    <address class="mt-1 not-italic text-slate-600">{{ config('bicsmart.contact.office') }}<br>{{ config('bicsmart.contact.address') }}</address>
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode('-7.413484,+109.272845') }}" target="_blank" rel="noopener" class="mt-3 inline-flex items-center gap-1 text-sm font-semibold text-emerald-700">Buka di Google Maps <x-ui-icon name="arrow-right" class="h-4 w-4" /></a>
                </div>
                <div>
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500 text-white"><x-ui-icon name="mail" class="h-6 w-6" /></span>
                    <h2 class="mt-4 text-lg font-bold">Email</h2>
                    <ul class="mt-1 space-y-1">
                        @foreach (config('bicsmart.contact.emails') as $email)
                        <li><a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to={{ urlencode($email) }}" target="_blank" rel="noopener noreferrer" class="font-medium text-navy-700 underline decoration-navy-200 underline-offset-4 hover:text-emerald-700">{{ $email }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="bento-navy relative overflow-hidden">
            <h2 class="text-lg font-bold">Ada ovitrap tumpah atau rusak?</h2>
            <p class="mt-2 text-sm text-navy-200">Sampaikan kepada kader kesehatan atau Ketua RT setempat agar segera diganti dengan unit baru. Terima kasih sudah ikut menjaga!</p>
            <img src="{{ asset('images/mascot-avatar.png') }}" alt="" class="absolute -bottom-3 -right-2 h-32 w-auto" loading="lazy" width="100" height="130">
            <div class="h-24"></div>
        </div>
    </div>
</section>
@endsection
