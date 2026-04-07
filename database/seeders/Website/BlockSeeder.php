<?php

namespace Database\Seeders\Website;

use Galaxy\WebsiteBlocks\Models\Block;
use Illuminate\Database\Seeder;

class BlockSeeder extends Seeder
{
    public function run(): void
    {
        // Add default blocks
        Block::create([
            'website_id' => 1,
            'block_category_id' => null,
            'title' => 'Header top balk',
            'extra' => [],
        ]);
    }
}
