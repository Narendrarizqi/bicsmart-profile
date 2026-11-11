<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $team = [
            // Tim Peneliti
            ['Juli Rochmijati Wuliandari, S.Si., M.Si., Ph.D.', 'Ketua Tim Peneliti (PI)', null, 'peneliti'],
            ['Dr. Wida Purwidianti, S.E., M.Sc.', 'Co-PI', 'Sosial & Bisnis', 'peneliti'],
            ['Dr. Gunawan, S.Pd., M.Sc.', 'Co-PI', 'Edukasi & Pelatihan', 'peneliti'],
            ['Ika Ariani Kartini, S.H., LL.M.', 'Co-PI', 'Regulasi & Tata Kelola', 'peneliti'],
            ['Dr. Isna Hikmawati, S.K.M., M.Kes. EPID', 'Co-PI', 'Epidemiologi', 'peneliti'],
            ['Dr.rer.nat. Anang Widhi Nirwansyah, M.Sc.', 'Co-PI', 'Pemodelan Spasial & GIS-EWS', 'peneliti'],
            // Tim Pelaksana
            ["Anisah Qurrotu'ainii, S.Si.", 'Research Assistant 1', null, 'pelaksana'],
            ['Hercules Pungky Naga Dewa, S.Pd.', 'Research Assistant 2', null, 'pelaksana'],
            ['Resti Dita Septianita, S.Pd.', 'Project Management Office (PMO)', null, 'pelaksana'],
            ['Nabila Rahmah Nur Safiqoh, S.Pd.', 'Project Management Office (PMO)', null, 'pelaksana'],
            ['Bagus Narendra Rizqi Ananto', 'Tim Teknologi Informasi', null, 'pelaksana'],
        ];

        foreach ($team as $i => [$name, $position, $expertise, $group]) {
            TeamMember::updateOrCreate(['name' => $name], [
                'position' => $position,
                'expertise' => $expertise,
                'group' => $group,
                'institution' => 'Universitas Muhammadiyah Purwokerto',
                'order_index' => $i + 1,
                'is_active' => true,
            ]);
        }
    }
}
