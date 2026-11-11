<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            VillageSeeder::class,
            TeamMemberSeeder::class,
            FaqSeeder::class,
            ArticleSeeder::class,
            ActivitySeeder::class,
        ]);
    }
}
