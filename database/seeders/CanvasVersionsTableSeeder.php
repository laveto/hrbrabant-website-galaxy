<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CanvasVersionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('canvas_versions')->delete();
        
        \DB::table('canvas_versions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'canvas_id' => 1,
                'language' => 'nl',
                'editor_user_id' => 1,
                'is_active' => 1,
                'activated_at' => '2023-05-08 11:07:39',
                'created_at' => '2023-05-08 11:07:39',
                'updated_at' => '2023-05-11 15:15:55',
            ),
            1 => 
            array (
                'id' => 2,
                'canvas_id' => 2,
                'language' => 'nl',
                'editor_user_id' => 1,
                'is_active' => 1,
                'activated_at' => '2023-05-08 11:07:39',
                'created_at' => '2023-05-08 11:07:39',
                'updated_at' => '2023-05-08 11:07:39',
            ),
            2 => 
            array (
                'id' => 3,
                'canvas_id' => 3,
                'language' => 'nl',
                'editor_user_id' => 1,
                'is_active' => 1,
                'activated_at' => '2023-05-08 11:09:48',
                'created_at' => '2023-05-08 11:09:48',
                'updated_at' => '2023-05-08 11:09:48',
            ),
            3 => 
            array (
                'id' => 4,
                'canvas_id' => 4,
                'language' => 'nl',
                'editor_user_id' => 1,
                'is_active' => 1,
                'activated_at' => '2023-05-08 11:09:48',
                'created_at' => '2023-05-08 11:09:48',
                'updated_at' => '2023-05-08 11:09:48',
            ),
            4 => 
            array (
                'id' => 5,
                'canvas_id' => 5,
                'language' => 'nl',
                'editor_user_id' => 1,
                'is_active' => 1,
                'activated_at' => '2023-05-08 12:21:53',
                'created_at' => '2023-05-08 12:21:53',
                'updated_at' => '2023-05-12 11:39:04',
            ),
            5 => 
            array (
                'id' => 6,
                'canvas_id' => 6,
                'language' => 'nl',
                'editor_user_id' => 1,
                'is_active' => 1,
                'activated_at' => '2023-05-08 12:21:59',
                'created_at' => '2023-05-08 12:21:59',
                'updated_at' => '2023-05-08 12:21:59',
            ),
            6 => 
            array (
                'id' => 7,
                'canvas_id' => 7,
                'language' => 'nl',
                'editor_user_id' => 1,
                'is_active' => 1,
                'activated_at' => '2023-05-08 12:22:03',
                'created_at' => '2023-05-08 12:22:03',
                'updated_at' => '2023-05-08 12:22:03',
            ),
            7 => 
            array (
                'id' => 8,
                'canvas_id' => 8,
                'language' => 'nl',
                'editor_user_id' => 1,
                'is_active' => 1,
                'activated_at' => '2023-05-08 12:22:08',
                'created_at' => '2023-05-08 12:22:08',
                'updated_at' => '2023-05-08 12:22:08',
            ),
            8 => 
            array (
                'id' => 9,
                'canvas_id' => 9,
                'language' => 'nl',
                'editor_user_id' => 1,
                'is_active' => 1,
                'activated_at' => '2023-05-08 12:22:13',
                'created_at' => '2023-05-08 12:22:13',
                'updated_at' => '2023-05-08 12:22:13',
            ),
            9 => 
            array (
                'id' => 11,
                'canvas_id' => 11,
                'language' => 'nl',
                'editor_user_id' => 1,
                'is_active' => 1,
                'activated_at' => '2023-05-11 13:21:24',
                'created_at' => '2023-05-11 13:21:24',
                'updated_at' => '2023-05-11 13:21:24',
            ),
            10 => 
            array (
                'id' => 12,
                'canvas_id' => 12,
                'language' => 'nl',
                'editor_user_id' => 1,
                'is_active' => 1,
                'activated_at' => '2023-05-11 13:21:29',
                'created_at' => '2023-05-11 13:21:29',
                'updated_at' => '2023-05-11 13:21:29',
            ),
        ));
        
        
    }
}