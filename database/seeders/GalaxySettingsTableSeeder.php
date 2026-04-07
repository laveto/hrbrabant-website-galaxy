<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GalaxySettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('galaxy_settings')->delete();
        
        \DB::table('galaxy_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tenant_type' => NULL,
                'tenant_id' => NULL,
                'category' => 'theme',
                'settings' => '{"mail": {"logo": "4"}, "color": {"primary": "#D65A54", "tailwind": {"blue": "#D65A54", "gray": "#9CA3AF", "darkblue": "#A8403B", "darkgray": "#4B5563", "lightblue": "#E88A85", "darkishblue": "#DE726D", "grayishblue": "#B54B46", "greyishblue": "#B54B46", "lighterblue": "#EDA5A1", "lightestblue": "#FDF2F1", "grayishlighterbue": "#C25550", "greyishlighterbue": "#C25550"}, "tertiary": "#A8403B", "secondary": "#B54B46", "primary-inverse": "#FFFFFF", "tertiary-inverse": "#FFFFFF", "secondary-inverse": "#FFFFFF"}, "fonts": {"base": "Exo", "heading": "Exo", "alternative": "Exo"}, "website": {"logo": "2", "footer_logo": "db209cde-a289-4c2a-a1ae-462ed4bbb015/logo-white.svg", "footer_image": "24"}, "footer_canvas": 4, "header_button": "Vacatures", "header_canvas": 3, "header_button_link": "/vacatures"}',
                'created_at' => '2023-05-08 11:09:48',
                'updated_at' => '2023-05-12 10:51:14',
            ),
            1 => 
            array (
                'id' => 2,
                'tenant_type' => NULL,
                'tenant_id' => NULL,
                'category' => 'common',
                'settings' => '{"Vimeo_link": null, "TikTok_link": null, "Twitter_link": null, "YouTube_link": null, "Facebook_link": "https://facebook.com", "Linkedin_link": "https://linkedin.com", "website_title": "HR Brabant", "Instagram_link": "https://instagram.com", "Pinterest_link": null}',
                'created_at' => '2023-05-08 12:25:54',
                'updated_at' => '2023-05-11 14:33:21',
            ),
        ));
        
        
    }
}