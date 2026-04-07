<?php

namespace App\Modules\WebsiteNews\Providers;

use Galaxy\Core\Contracts\ProvidesTestUrls;
use Galaxy\Core\Library\Concord\ConcordBaseModuleServiceProvider;

class ModuleServiceProvider extends ConcordBaseModuleServiceProvider
{
    public function register()
    {
        parent::register();

        $this->app->tag(TestUrlProvider::class, ProvidesTestUrls::class);
    }

}
