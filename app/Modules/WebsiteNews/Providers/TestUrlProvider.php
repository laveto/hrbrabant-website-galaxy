<?php

namespace App\Modules\WebsiteNews\Providers;

use Galaxy\Core\Console\Commands\Concerns\SimpleModuleTestUrlProvider;

class TestUrlProvider extends SimpleModuleTestUrlProvider
{
    public function getProviderName(): string
    {
        return 'News';
    }

    protected function moduleId(): string
    {
        return 'website_news::news';
    }

    protected function modelClass(): ?string
    {
        return \App\Modules\WebsiteNews\Models\WebsiteNews::class;
    }
}
