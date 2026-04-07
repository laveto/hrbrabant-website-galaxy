<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlocksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('blocks')->delete();
        
        \DB::table('blocks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'website_id' => 1,
                'block_category_id' => 1,
                'key' => 'footer',
                'title' => 'Footer',
                'extra' => '{"kolom_1_->_titel":{"value":"Info","type":"text"},"kolom_2_->_titel_1":{"value":"Ervaring","type":"text"},"kolom_2_->_beschrijving":{"value":"<p><a href=\\"page:\\/\\/5\\">Reviews<\\/a><\\/p>","type":"richtext"},"kolom_2_->_titel_2":{"value":"Vragen?","type":"text"},"kolom_2_->_beschrijving_2":{"value":"<p><a href=\\"page:\\/\\/6\\">Contact<\\/a><\\/p>","type":"richtext"},"kolom_3_->_titel":{"value":"Bezoekadres","type":"text"},"kolom_3_->_beschrijving":{"value":"<p>De Jongestraat 6<br \\/>\\r\\n4531 GL Terneuzen<\\/p>","type":"richtext"}}',
                'created_at' => '2023-05-08 11:07:39',
                'updated_at' => '2023-05-11 13:16:47',
            ),
        ));
        
        
    }
}