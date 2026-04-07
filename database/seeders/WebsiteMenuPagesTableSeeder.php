<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WebsiteMenuPagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('website_menu_pages')->delete();
        
        \DB::table('website_menu_pages')->insert(array (
            0 => 
            array (
                'id' => 2,
                'website_id' => 1,
                'website_page_id' => 1,
                'website_menu_id' => 3,
                'created_at' => '2023-05-08 12:21:49',
                'updated_at' => '2023-05-08 12:21:49',
                '_lft' => 1,
                '_rgt' => 2,
                'parent_id' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'website_id' => 1,
                'website_page_id' => 2,
                'website_menu_id' => 1,
                'created_at' => '2023-05-08 12:21:53',
                'updated_at' => '2023-05-08 12:21:53',
                '_lft' => 1,
                '_rgt' => 2,
                'parent_id' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'website_id' => 1,
                'website_page_id' => 3,
                'website_menu_id' => 1,
                'created_at' => '2023-05-08 12:21:59',
                'updated_at' => '2023-05-08 12:21:59',
                '_lft' => 3,
                '_rgt' => 4,
                'parent_id' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'website_id' => 1,
                'website_page_id' => 4,
                'website_menu_id' => 1,
                'created_at' => '2023-05-08 12:22:03',
                'updated_at' => '2023-05-08 12:22:03',
                '_lft' => 5,
                '_rgt' => 6,
                'parent_id' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'website_id' => 1,
                'website_page_id' => 5,
                'website_menu_id' => 1,
                'created_at' => '2023-05-08 12:22:08',
                'updated_at' => '2023-05-08 12:22:08',
                '_lft' => 7,
                '_rgt' => 8,
                'parent_id' => NULL,
            ),
            5 => 
            array (
                'id' => 7,
                'website_id' => 1,
                'website_page_id' => 6,
                'website_menu_id' => 1,
                'created_at' => '2023-05-08 12:22:13',
                'updated_at' => '2023-05-08 12:22:13',
                '_lft' => 9,
                '_rgt' => 10,
                'parent_id' => NULL,
            ),
            6 => 
            array (
                'id' => 9,
                'website_id' => 1,
                'website_page_id' => 2,
                'website_menu_id' => 2,
                'created_at' => '2023-05-11 11:18:01',
                'updated_at' => '2023-05-11 11:18:01',
                '_lft' => 1,
                '_rgt' => 2,
                'parent_id' => NULL,
            ),
            7 => 
            array (
                'id' => 10,
                'website_id' => 1,
                'website_page_id' => 3,
                'website_menu_id' => 2,
                'created_at' => '2023-05-11 11:18:04',
                'updated_at' => '2023-05-11 11:18:04',
                '_lft' => 3,
                '_rgt' => 4,
                'parent_id' => NULL,
            ),
            8 => 
            array (
                'id' => 11,
                'website_id' => 1,
                'website_page_id' => 4,
                'website_menu_id' => 2,
                'created_at' => '2023-05-11 11:18:09',
                'updated_at' => '2023-05-11 11:18:09',
                '_lft' => 5,
                '_rgt' => 6,
                'parent_id' => NULL,
            ),
            9 => 
            array (
                'id' => 12,
                'website_id' => 1,
                'website_page_id' => 5,
                'website_menu_id' => 2,
                'created_at' => '2023-05-11 11:18:13',
                'updated_at' => '2023-05-11 11:18:13',
                '_lft' => 7,
                '_rgt' => 8,
                'parent_id' => NULL,
            ),
            10 => 
            array (
                'id' => 13,
                'website_id' => 1,
                'website_page_id' => 6,
                'website_menu_id' => 2,
                'created_at' => '2023-05-11 11:18:16',
                'updated_at' => '2023-05-11 11:18:16',
                '_lft' => 9,
                '_rgt' => 10,
                'parent_id' => NULL,
            ),
            11 => 
            array (
                'id' => 14,
                'website_id' => 1,
                'website_page_id' => 8,
                'website_menu_id' => 4,
                'created_at' => '2023-05-11 13:21:24',
                'updated_at' => '2023-05-11 13:21:24',
                '_lft' => 1,
                '_rgt' => 2,
                'parent_id' => NULL,
            ),
            12 => 
            array (
                'id' => 15,
                'website_id' => 1,
                'website_page_id' => 9,
                'website_menu_id' => 4,
                'created_at' => '2023-05-11 13:21:29',
                'updated_at' => '2023-05-11 13:21:29',
                '_lft' => 3,
                '_rgt' => 4,
                'parent_id' => NULL,
            ),
            13 => 
            array (
                'id' => 16,
                'website_id' => 1,
                'website_page_id' => 10,
                'website_menu_id' => 1,
                'created_at' => '2024-10-29 11:01:37',
                'updated_at' => '2024-10-29 11:01:37',
                '_lft' => 11,
                '_rgt' => 12,
                'parent_id' => NULL,
            ),
        ));
        
        
    }
}