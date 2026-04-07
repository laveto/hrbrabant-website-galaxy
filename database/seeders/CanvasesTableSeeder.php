<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CanvasesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('canvases')->delete();
        
        \DB::table('canvases')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tag' => NULL,
                'created_at' => '2023-05-08 11:07:39',
                'updated_at' => '2023-05-11 15:15:55',
            ),
            1 => 
            array (
                'id' => 2,
                'tag' => 'website-404',
                'created_at' => '2023-05-08 11:07:39',
                'updated_at' => '2023-05-08 11:07:39',
            ),
            2 => 
            array (
                'id' => 3,
                'tag' => NULL,
                'created_at' => '2023-05-08 11:09:48',
                'updated_at' => '2023-05-08 11:09:48',
            ),
            3 => 
            array (
                'id' => 4,
                'tag' => NULL,
                'created_at' => '2023-05-08 11:09:48',
                'updated_at' => '2023-05-08 11:09:48',
            ),
            4 => 
            array (
                'id' => 5,
                'tag' => NULL,
                'created_at' => '2023-05-08 12:21:53',
                'updated_at' => '2023-05-12 11:39:04',
            ),
            5 => 
            array (
                'id' => 6,
                'tag' => NULL,
                'created_at' => '2023-05-08 12:21:59',
                'updated_at' => '2023-05-08 12:21:59',
            ),
            6 => 
            array (
                'id' => 7,
                'tag' => NULL,
                'created_at' => '2023-05-08 12:22:03',
                'updated_at' => '2023-05-08 12:22:03',
            ),
            7 => 
            array (
                'id' => 8,
                'tag' => NULL,
                'created_at' => '2023-05-08 12:22:08',
                'updated_at' => '2023-05-08 12:22:08',
            ),
            8 => 
            array (
                'id' => 9,
                'tag' => NULL,
                'created_at' => '2023-05-08 12:22:13',
                'updated_at' => '2023-05-08 12:22:13',
            ),
            9 => 
            array (
                'id' => 11,
                'tag' => NULL,
                'created_at' => '2023-05-11 13:21:24',
                'updated_at' => '2023-05-11 13:21:24',
            ),
            10 => 
            array (
                'id' => 12,
                'tag' => NULL,
                'created_at' => '2023-05-11 13:21:29',
                'updated_at' => '2023-05-11 13:21:29',
            ),
        ));
        
        
    }
}