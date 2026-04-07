<?php

namespace Database\Seeders\Website;

use Galaxy\WebsiteBlocks\Models\BlockCategory;
use Illuminate\Database\Seeder;

class BlockCategorySeeder extends Seeder
{
    public function run(): void
    {
        // Add default
        BlockCategory::create([
            'website_id' => 1,
            'name' => 'Categorie 1',
            'extra' => '',
        ]);
    }
}
