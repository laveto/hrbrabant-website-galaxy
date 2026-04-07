<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FormsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('forms')->delete();
        
        \DB::table('forms')->insert(array (
            0 => 
            array (
                'id' => 1,
                'website_id' => 1,
                'name' => 'Contact',
                'message' => 'Bedankt voor uw bericht. Wij nemen zo spoedig mogelijk contact met u op.',
                'message_email_confirmation' => NULL,
                'fields' => '[{"__dataset_item_id":"0","name":"Naam","type":"text","value":null,"placeholder":null,"published":"1"},{"name":"E-mail","type":"email","value":null,"placeholder":null,"published":"1"},{"name":"Onderwerp","type":"text","value":null,"placeholder":null,"published":"1"},{"name":"Bericht","type":"textarea","value":null,"placeholder":null,"published":"1"},{"name":"Verstuur","type":"submit","value":null,"placeholder":null,"published":"1"}]',
                'autoreply' => NULL,
                'email' => 'info@laveto.nl',
                'show_required_text' => 1,
                'mail_user' => 0,
                'save_database' => 0,
                'payment_active' => 0,
                'payment_product_quantity' => 1,
                'payment_amount' => 0,
                'payment_description' => NULL,
                'redirect' => 0,
                'redirect_page' => NULL,
                'recaptcha' => 'v3',
                'published' => 1,
                'locked' => 0,
                'created_at' => '2024-10-29 10:59:26',
                'updated_at' => '2024-10-29 10:59:26',
            ),
        ));
        
        
    }
}