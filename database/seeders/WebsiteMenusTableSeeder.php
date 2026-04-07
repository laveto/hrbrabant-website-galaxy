<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WebsiteMenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('website_menus')->delete();
        
        \DB::table('website_menus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Main',
                'description' => 'Dit is het hoofdmenu, welke op elke pagina bovenaan getoond wordt.',
                'order_column' => 1,
                'created_at' => '2023-05-08 11:07:39',
                'updated_at' => '2023-05-08 11:07:39',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Footer',
                'description' => 'Dit menu wordt onderaan de pagina vertoond.',
                'order_column' => 2,
                'created_at' => '2023-05-08 11:07:39',
                'updated_at' => '2023-05-08 11:07:39',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Los',
                'description' => 'Dit zijn pagina\'s die niet in een menu worden vertoond maar wel bereikbaar zijn op de website.',
                'order_column' => 4,
                'created_at' => '2023-05-08 11:07:39',
                'updated_at' => '2023-05-08 11:07:39',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Subfooter',
                'description' => 'Pagina\'s die getoond worden onder aan de footer naast de copyright',
                'order_column' => 3,
                'created_at' => '2023-05-11 13:20:52',
                'updated_at' => '2023-05-11 13:20:52',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Mobiel',
                'description' => 'Pagina\'s die getoond worden in het mobiele menu',
                'order_column' => 5,
                'created_at' => '2023-05-11 13:20:52',
                'updated_at' => '2023-05-11 13:20:52',
            ),
        ));
        
        
    }
}