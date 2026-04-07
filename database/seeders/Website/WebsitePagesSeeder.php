<?php

namespace Database\Seeders\Website;

use Database\Seeders\Website\Pages\HomeSeeder;
use Illuminate\Database\Seeder;

class WebsitePagesSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            HomeSeeder::class,
        ]);
    }
}
