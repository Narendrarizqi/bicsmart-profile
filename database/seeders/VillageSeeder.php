<?php

namespace Database\Seeders;

use App\Models\Village;
use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
    public function run(): void
    {
        $villages = [
            ['ledug', 'LED', 'Ledug', 'Kembaran'],
            ['purwodadi', 'PUR', 'Purwodadi', 'Kembaran'],
            ['kedung_randu', 'KDR', 'Kedungrandu', 'Patikraja'],
            ['teluk', 'TLK', 'Teluk', 'Purwokerto Selatan'],
            ['karang_klesem', 'KKS', 'Karangklesem', 'Purwokerto Selatan'],
            ['sokanegara', 'SKN', 'Sokanegara', 'Purwokerto Timur'],
            ['karangnanas', 'KGN', 'Karangnanas', 'Sokaraja'],
            ['purwosari', 'PWS', 'Purwosari', 'Baturaden'],
            ['beji', 'BEJ', 'Beji', 'Kedungbanteng'],
            ['kober', 'KBR', 'Kober', 'Purwokerto Barat'],
            ['sumampir', 'SMP', 'Sumampir', 'Purwokerto Utara'],
            ['tanggeran', 'TGR', 'Tanggeran', 'Somagede'],
        ];

        foreach ($villages as $i => [$slug, $code, $name, $district]) {
            Village::updateOrCreate(['slug' => $slug], [
                'code' => $code, 'name' => $name, 'district' => $district, 'order_index' => $i + 1,
            ]);
        }
    }
}
