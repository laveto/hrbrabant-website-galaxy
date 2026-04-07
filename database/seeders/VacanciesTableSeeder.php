<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VacanciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('vacancies')->delete();
        
        
        
    }
}