<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['wolbachia', 'Apakah nyamuk Wolbachia menggigit dan menularkan penyakit?',
                'Nyamuk tetap menggigit, tapi bakteri Wolbachia memblokir virus DBD, Zika, dan Chikungunya di dalam tubuh nyamuk sehingga virus tidak bisa menular ke manusia. Bakteri ini alami dan aman.'],
            ['ovitrap', 'Mengapa ada ember hitam ber-QR di rumah saya?',
                'Ember itu ovitrap ramah lingkungan untuk memantau kepadatan telur nyamuk. Airnya diganti dan diperiksa mingguan oleh kader, tidak akan menjadi sarang nyamuk.'],
            ['ovitrap', 'Bagaimana jika ovitrap tumpah, hanyut, atau rusak?',
                'Sampaikan ke kader kesehatan atau Ketua RT setempat agar segera diganti dengan unit baru. Anda juga bisa menghubungi sekretariat BiC-SMART melalui halaman Kontak.'],
            ['wolbachia', 'Apakah Wolbachia hasil rekayasa genetika?',
                'Bukan. Wolbachia adalah bakteri alami yang sudah lama hidup di banyak jenis serangga, seperti kupu-kupu, lebah, dan lalat buah. Nyamuk Aedes aegypti tidak diubah gennya, hanya dititipi bakteri alami ini.'],
            ['wolbachia', 'Apakah Wolbachia bisa berpindah ke manusia atau hewan peliharaan?',
                'Tidak. Wolbachia hanya dapat hidup di dalam sel serangga. Bakteri ini tidak dapat bertahan hidup di tubuh manusia, hewan peliharaan, maupun di lingkungan.'],
            ['umum', 'Apa itu BiC-SMART?',
                'BiC-SMART (Bio-Control Strategy, Modeling & Adaptive Readiness Technologies) adalah program riset Universitas Muhammadiyah Purwokerto bersama Dinas Kesehatan Kabupaten Banyumas untuk menyiapkan warga, memantau nyamuk, dan memodelkan risiko DBD menuju Zero Death by Dengue 2030.'],
            ['umum', 'Di desa mana saja program ini berjalan?',
                'Program berjalan di 12 desa mitra di Kabupaten Banyumas: Ledug, Purwodadi, Kedungrandu, Teluk, Karangklesem, Sokanegara, Karangnanas, Purwosari, Beji, Kober, Sumampir, dan Tanggeran.'],
            ['umum', 'Apakah data saya sebagai responden aman?',
                'Ya. Identitas responden disamarkan (pseudonimisasi) sebelum data dianalisis, dan penelitian ini telah memperoleh kelaikan etik dari Komite Etik Penelitian LPPM Universitas Jenderal Soedirman.'],
        ];

        foreach ($faqs as $i => [$cat, $q, $a]) {
            Faq::updateOrCreate(['question' => $q], [
                'answer' => $a, 'category' => $cat, 'order_index' => $i + 1,
                'show_in_widget' => true, 'is_active' => true,
            ]);
        }
    }
}
