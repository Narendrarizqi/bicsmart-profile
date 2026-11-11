<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Tiga berita awal. Naskah ini adalah DRAF yang disusun dari judul & fakta
 * program; mohon disunting tim Humas melalui CMS sebelum dipublikasikan luas.
 */
class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::where('role', User::ROLE_SUPER_ADMIN)->first();

        $articles = [
            [
                'title' => 'Pelatihan 120 Enumerator BiC-SMART: Kolaborasi 60 Mahasiswa UMP dan 60 Kader Kesehatan Desa',
                'published_at' => '2026-10-10 09:00:00',
                'summary' => 'Sebanyak 120 enumerator yang terdiri atas 60 mahasiswa UMP dan 60 kader kesehatan desa mengikuti pelatihan sebagai persiapan survei kesiapan sosial di 12 desa mitra.',
                'content' => <<<'HTML'
<p>Program BiC-SMART menggelar pelatihan bagi <strong>120 enumerator</strong> yang akan bertugas dalam survei kesiapan sosial warga (Work Package 1). Para enumerator terdiri atas <strong>60 mahasiswa Universitas Muhammadiyah Purwokerto (UMP)</strong> dan <strong>60 kader kesehatan</strong> dari 12 desa mitra di Kabupaten Banyumas.</p>
<p>Perpaduan mahasiswa dan kader desa dipilih agar survei berjalan dengan pendekatan yang akrab bagi warga. Kader memahami kondisi lingkungan dan warganya, sementara mahasiswa membawa kemampuan pengumpulan data digital.</p>
<h2>Materi pelatihan</h2>
<ul>
<li>Pengenalan program BiC-SMART dan target <em>Zero Death by Dengue 2030</em>.</li>
<li>Pengenalan teknologi nyamuk ber-Wolbachia sebagai pelengkap upaya 3M Plus.</li>
<li>Teknik wawancara yang santun dan cara meminta persetujuan (<em>informed consent</em>) responden.</li>
<li>Penggunaan formulir digital KoBoToolbox di ponsel.</li>
<li>Etika penelitian dan kerahasiaan data responden.</li>
</ul>
<p>Setelah pelatihan, para enumerator akan mendatangi rumah warga di 12 desa mitra untuk survei baseline kesiapan sosial.</p>
HTML,
            ],
            [
                'title' => 'Survei Baseline Kesiapan Sosial 2.400 KK di 12 Desa Rampung Dilaksanakan',
                'published_at' => '2026-10-29 09:00:00',
                'summary' => 'Survei baseline kesiapan sosial yang berlangsung 17–28 Oktober 2026 telah menjangkau 2.400 kepala keluarga di 12 desa mitra BiC-SMART.',
                'content' => <<<'HTML'
<p>Survei baseline kesiapan sosial warga Program BiC-SMART telah rampung dilaksanakan pada <strong>17–28 Oktober 2026</strong>. Survei ini menjangkau <strong>2.400 kepala keluarga (KK)</strong> di <strong>12 desa mitra</strong> di Kabupaten Banyumas.</p>
<p>Survei bertujuan memahami pengetahuan, sikap, dan kesiapan warga terhadap rencana penerapan teknologi nyamuk ber-Wolbachia. Hasilnya akan menjadi dasar penyusunan strategi edukasi dan komunikasi yang sesuai dengan kebutuhan setiap desa.</p>
<h2>Dikerjakan bersama warga</h2>
<p>Pengumpulan data dilakukan oleh 120 enumerator gabungan mahasiswa UMP dan kader kesehatan desa menggunakan formulir digital. Setiap responden diminta persetujuannya sebelum wawancara, dan identitasnya disamarkan sebelum data dianalisis.</p>
<p>Tim BiC-SMART menyampaikan terima kasih kepada seluruh warga, perangkat desa, kader, dan Dinas Kesehatan Kabupaten Banyumas atas dukungan selama survei berlangsung.</p>
HTML,
            ],
            [
                'title' => 'Gelar 600 Ovitrap Ber-QR di 12 Desa Sentinel Banyumas untuk Surveilans Telur Aedes',
                'published_at' => '2026-11-03 09:00:00',
                'summary' => 'BiC-SMART menempatkan 600 ember ovitrap ber-QR (300 di dalam dan 300 di luar rumah) di 12 desa sentinel untuk memantau kepadatan telur nyamuk Aedes selama 12 minggu.',
                'content' => <<<'HTML'
<p>Memasuki November 2026, Program BiC-SMART mulai menempatkan <strong>600 ember ovitrap ber-QR</strong> di <strong>12 desa sentinel</strong> Kabupaten Banyumas. Sebanyak 300 unit ditempatkan di dalam rumah dan 300 unit di luar rumah.</p>
<h2>Apa itu ovitrap?</h2>
<p>Ovitrap adalah perangkap telur nyamuk sederhana berupa ember hitam berisi air dan media tempat nyamuk bertelur. Dengan menghitung telur yang tertangkap, tim dapat memperkirakan kepadatan nyamuk <em>Aedes aegypti</em> di suatu wilayah.</p>
<p>Air dalam ovitrap diganti dan diperiksa setiap minggu oleh kader, sehingga ember tidak akan menjadi sarang nyamuk. Kode QR pada setiap ember memudahkan pencatatan data secara digital.</p>
<h2>Pemantauan 12 minggu</h2>
<p>Pemantauan berlangsung selama 12 minggu. Data kepadatan telur ini menjadi gambaran awal kondisi nyamuk di setiap desa sebelum intervensi, sekaligus bahan pemodelan risiko DBD.</p>
<p>Warga yang rumahnya ditempati ovitrap dimohon untuk tidak memindahkan atau membuang air di dalam ember. Jika ember tumpah atau rusak, silakan sampaikan kepada kader atau Ketua RT setempat.</p>
HTML,
            ],
        ];

        foreach ($articles as $i => $a) {
            Article::updateOrCreate(['title' => $a['title']], $a + [
                'category' => 'berita',
                'status' => 'published',
                'author_id' => $author?->id,
                'is_featured' => $i === 2,
            ]);
        }
    }
}
