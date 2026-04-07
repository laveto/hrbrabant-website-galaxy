<?php

namespace Database\Seeders\Website;

use Galaxy\Website\Models\WebsiteMenu;
use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{
    public function run(): void
    {
        WebsiteMenu::create([
            'name' => 'Main',
            'description' => 'Dit is het hoofdmenu, welke op elke pagina bovenaan getoond wordt.',
        ]);

        WebsiteMenu::create([
            'name' => 'Footer',
            'description' => 'Dit menu wordt onderaan de pagina vertoond.',
        ]);

        WebsiteMenu::create([
            'name' => 'Los',
            'description' => 'Dit zijn pagina\'s die niet in een menu worden vertoond maar wel bereikbaar zijn op de website.',
        ]);
    }
}
