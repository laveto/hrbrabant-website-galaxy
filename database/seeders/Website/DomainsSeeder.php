<?php

namespace Database\Seeders\Website;

use Galaxy\Website\Models\WebsiteDomain;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Command\Command as CommandAlias;

class DomainsSeeder extends Seeder
{
    public function run(): int
    {
        // Define url
        $websiteUrlFromConfig = parse_url(config('app.url'), PHP_URL_HOST);

        // Check if exists
        if (WebsiteDomain::where('host', $websiteUrlFromConfig)->first()) {
            return CommandAlias::SUCCESS;
        }

        // Add default website
        WebsiteDomain::create([
            'host' => $websiteUrlFromConfig,
            'website_id' => 1,
            'language' => config('core.languages') > 1 ? collect(config('core.languages'))->first() : null,
        ]);

        return CommandAlias::SUCCESS;
    }
}
