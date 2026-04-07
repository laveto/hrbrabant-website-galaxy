<?php

namespace Database\Seeders;

use Exception;
use Galaxy\Website\Resources\Database\Seeders\CanvasFourOFourSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Psr\SimpleCache\InvalidArgumentException;
use Symfony\Component\Console\Output\ConsoleOutput;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @throws InvalidArgumentException
     */
    public function run(): void
    {
        // Seed Galaxy common data.
        //$this->call(WebsiteSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(PermissionsSeeder::class);

        // Seed website?
        if (concord()->module('website')) {
            $this->call(WebsitesSeeder::class);
            $this->call(CanvasFourOFourSeeder::class);
            //$this->call(FormsTableSeeder::class);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Needed so the iSeed command places the calls correctly
        #iseed_start

        $this->call(CanvasesTableSeeder::class);
        $this->call(CanvasVersionsTableSeeder::class);
        $this->call(CanvasBlocksTableSeeder::class);
        $this->call(WebsiteMenusTableSeeder::class);
        $this->call(WebsitePagesTableSeeder::class);
        $this->call(WebsiteMenuPagesTableSeeder::class);
        $this->call(BlockCategoriesTableSeeder::class);
        $this->call(BlocksTableSeeder::class);
        $this->call(GalaxySettingsTableSeeder::class);
        $this->call(MembersTableSeeder::class);
        $this->call(VacanciesTableSeeder::class);
        #iseed_end

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->indexSearch();

        $this->command->info('Successfully finished seeding.');
    }

    /**
     * Index all available searches
     */
    protected function indexSearch(): void
    {
        try {
            // Index search.
            Artisan::call('core:search-index');
        } catch (Exception $ex) {
            $out = new ConsoleOutput();
            $out->writeln('<error>Could not index for searching: '.rtrim($ex->getMessage()).'</error>');
        }
    }
}
