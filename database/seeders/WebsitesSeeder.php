<?php

namespace Database\Seeders;

use Database\Seeders\Website\BlockCategorySeeder;
use Database\Seeders\Website\BlockSeeder;
use Database\Seeders\Website\DomainsSeeder;
use Database\Seeders\Website\FormSeeder;
use Database\Seeders\Website\MenusSeeder;
use Database\Seeders\Website\WebsitePagesSeeder;
use Galaxy\Website\Resources\Database\Seeders\TailwindPaletteColorsToDatabaseSeeder;
use Galaxy\Website\Resources\Database\Seeders\WebsiteNamesSeeder;
use Illuminate\Database\Seeder;

class WebsitesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TailwindPaletteColorsToDatabaseSeeder::class,
            WebsiteNamesSeeder::class,
            DomainsSeeder::class,
            MenusSeeder::class,
            WebsitePagesSeeder::class,
            BlockCategorySeeder::class,
            BlockSeeder::class,
            FormSeeder::class,
        ]);
    }
}
