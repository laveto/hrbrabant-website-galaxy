<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlockCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('block_categories')->delete();
        
        \DB::table('block_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'website_id' => 1,
                'name' => 'Footer',
                'extra' => '[{"__dataset_item_id":null,"name":"Kolom 1 -> Titel","type":"text","value":null,"placeholder":null,"required":"1","published":"1"},{"__dataset_item_id":null,"name":"Kolom 2 -> Titel 1","type":"text","value":null,"placeholder":null,"required":"1","published":"1"},{"__dataset_item_id":null,"name":"Kolom 2 -> Beschrijving","type":"richtext","value":null,"placeholder":null,"required":"1","published":"1"},{"__dataset_item_id":null,"name":"Kolom 2 -> Titel 2","type":"text","value":null,"placeholder":null,"required":"1","published":"1"},{"__dataset_item_id":null,"name":"Kolom 2 -> Beschrijving 2","type":"richtext","value":null,"placeholder":null,"required":"1","published":"1"},{"__dataset_item_id":null,"name":"Kolom 3 -> Titel","type":"text","value":null,"placeholder":null,"required":"1","published":"1"},{"__dataset_item_id":null,"name":"Kolom 3 -> Beschrijving","type":"richtext","value":null,"placeholder":null,"required":"1","published":"1"}]',
                'created_at' => '2023-05-08 11:07:39',
                'updated_at' => '2023-05-11 11:23:23',
            ),
        ));
        
        
    }
}