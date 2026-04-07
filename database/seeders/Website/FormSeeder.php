<?php

namespace Database\Seeders\Website;

use Galaxy\WebsiteForms\Models\Form;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    public function run(): void
    {
        // Add default blocks
        Form::create([
            'website_id' => 1,
            'name' => 'Contact',
            'message' => 'Bedankt voor uw bericht. Wij nemen zo spoedig mogelijk contact met u op.',
            'fields' => [
                [
                    '__dataset_item_id' => '0',
                    'name' => 'Naam',
                    'type' => 'text',
                    'value' => null,
                    'placeholder' => null,
                    'published' => '1',
                ],
                [
                    'name' => 'E-mail',
                    'type' => 'email',
                    'value' => null,
                    'placeholder' => null,
                    'published' => '1',
                ],
                [
                    'name' => 'Onderwerp',
                    'type' => 'text',
                    'value' => null,
                    'placeholder' => null,
                    'published' => '1',
                ],
                [
                    'name' => 'Bericht',
                    'type' => 'textarea',
                    'value' => null,
                    'placeholder' => null,
                    'published' => '1',
                ],
                [
                    'name' => 'Verstuur',
                    'type' => 'submit',
                    'value' => null,
                    'placeholder' => null,
                    'published' => '1',
                ],
            ],
            'email' => 'info@laveto.nl',
            'recaptcha' => 'v3',
            'published' => 1,
        ]);
    }
}
