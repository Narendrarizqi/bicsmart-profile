<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Contoh catatan dokumentasi harian berdasarkan agenda program.
 * Foto dapat ditambahkan lewat CMS.
 */
class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $author = User::where('role', User::ROLE_SUPER_ADMIN)->first();

        $items = [
            ['2026-10-10', 'pelatihan', 'Pelatihan 120 enumerator survei kesiapan sosial', 'Universitas Muhammadiyah Purwokerto',
                'Pelatihan bagi 60 mahasiswa UMP dan 60 kader kesehatan desa sebagai enumerator survei baseline WP1, meliputi teknik wawancara, informed consent, penggunaan KoBoToolbox, dan etika data.'],
            ['2026-10-17', 'wp1', 'Hari pertama survei baseline kesiapan sosial', '12 desa mitra',
                'Enumerator mulai mendatangi rumah warga di 12 desa mitra untuk survei baseline kesiapan sosial. Target keseluruhan 2.400 kepala keluarga.'],
            ['2026-10-28', 'wp1', 'Survei baseline 2.400 KK rampung', '12 desa mitra',
                'Pengumpulan data survei baseline kesiapan sosial di 12 desa mitra selesai. Tahap berikutnya adalah pemeriksaan kelengkapan dan kualitas data.'],
            ['2026-11-03', 'wp3', 'Penempatan ovitrap ber-QR di desa sentinel', '12 desa sentinel',
                'Dimulainya penempatan 600 ember ovitrap ber-QR (300 dalam rumah, 300 luar rumah) untuk surveilans telur Aedes selama 12 minggu.'],
        ];

        foreach ($items as [$date, $cat, $title, $location, $desc]) {
            Activity::updateOrCreate(['title' => $title, 'activity_date' => $date], [
                'category' => $cat, 'location' => $location, 'description' => $desc,
                'status' => 'published', 'author_id' => $author?->id,
            ]);
        }
    }
}
