<?php

namespace Database\Seeders\Website\Pages;

use Galaxy\Canvas\Models\CanvasBlock;
use Galaxy\Canvas\Models\CanvasVersion;
use Galaxy\Website\Resources\Database\Seeders\WebsitePageSeeder;

class HomeSeeder extends WebsitePageSeeder
{
    protected function getWebsitePageData(): array
    {
        return [
            'slug' => [
                'nl' => '/',
            ],
            'title_page' => [
                'nl' => 'Home',
            ],
        ];
    }

    protected function seedCanvasBlockIntro(CanvasVersion $canvasVersion)
    {
        $canvasBlock = CanvasBlock::create([
            'canvas_version_id' => $canvasVersion->id,
            'block' => 'canvas::common.1column',
        ]);
    }
}
