<?php

/*
|--------------------------------------------------------------------------
| Identitas & kontak resmi BiC-SMART
|--------------------------------------------------------------------------
| Ubah nilai di sini (atau lewat .env) untuk memperbarui kontak, legalitas,
| dan daftar mitra yang tampil di seluruh website.
*/

return [
    'name' => 'BiC-SMART',
    'long_name' => 'Bio-Control Strategy, Modeling & Adaptive Readiness Technologies',
    'tagline' => 'Bersama Wujudkan Banyumas Bebas DBD 2030 Melalui Inovasi Wolbachia',
    'target' => 'Zero Death by Dengue 2030',

    'contact' => [
        'office' => 'Kantor Sekretariat Program BiC-SMART',
        'address' => 'Gedung Riset UMP, Jl. KH. Ahmad Dahlan, Kembaran, Banyumas, Jawa Tengah 53182',
        'emails' => ['bicsmart.id@gmail.com'],
        'whatsapp' => env('BICSMART_WHATSAPP'),   // contoh: 6281234567890
        'instagram' => env('BICSMART_INSTAGRAM'), // contoh: https://instagram.com/bicsmart
        'youtube' => env('BICSMART_YOUTUBE'),
    ],

    'legal' => [
        'grant' => 'Program Hilirisasi Riset Strategis SINERGI (Kemdiktisaintek & LPDP) 2024–2026',
        'ethics' => 'Komite Etik Penelitian (KEP) LPPM Universitas Jenderal Soedirman, Protokol No. 190',
    ],

    // Urutan tampil di header & bagian konsorsium. File ada di public/images/logos/.
    'partners' => [
        ['name' => 'Kementerian Pendidikan Tinggi, Sains, dan Teknologi', 'short' => 'Kemdiktisaintek', 'logo' => 'logo-kemdiktisaintek', 'role' => 'Pemberi hibah'],
        ['name' => 'Kampus Merdeka', 'short' => 'Kampus Merdeka', 'logo' => 'logo-kampus-merdeka', 'role' => 'Program pendukung'],
        ['name' => 'Universitas Muhammadiyah Purwokerto', 'short' => 'UMP', 'logo' => 'logo-ump', 'role' => 'Pelaksana riset'],
        ['name' => 'Pemerintah Kabupaten Banyumas / Dinas Kesehatan', 'short' => 'Dinkes Banyumas', 'logo' => 'logo-banyumas', 'role' => 'Mitra pemerintah'],
        ['name' => 'Persyarikatan Muhammadiyah', 'short' => 'Muhammadiyah', 'logo' => 'logo-muhammadiyah', 'role' => 'Mitra persyarikatan'],
        ['name' => 'BiC-SMART', 'short' => 'BiC-SMART', 'logo' => 'logo-bicsmart-full', 'role' => 'Program'],
    ],
];
