<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('members')->delete();
        
        \DB::table('members')->insert(array (
            0 => 
            array (
                'id' => 1,
                'website_id' => 1,
                'title' => '{"nl": "Jaco Stoffels"}',
                'subtitle' => '{"nl": "Mede-eigenaar"}',
                'slug' => '{"nl": "jaco-stoffels"}',
            'content' => '{"nl": "<p>Klanten en kandidaten omschrijven mij als een gedreven en loyale zakenpartner. Door mijn brede netwerk in Zeeland weet ik opdrachtgevers en kandidaten optimaal met elkaar te (ver)binden.</p>"}',
                'sequence' => 0,
                'email' => 'kevin@laveto.nl',
                'linkedin' => 'linkedin.com',
                'whatsapp' => 'whatsapp.cm',
                'published' => 1,
                'created_at' => '2023-05-12 09:49:59',
                'updated_at' => '2023-05-12 10:24:16',
            ),
        ));
        
        
    }
}