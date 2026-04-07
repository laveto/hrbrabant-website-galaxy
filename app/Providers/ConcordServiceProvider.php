<?php

namespace App\Providers;

use App\Http\Requests\Galaxy\Website\Admin\Settings\StoreTheme;
use App\Http\Requests\Galaxy\Website\Admin\StoreWebsitePage;
use App\Models\Galaxy\Settings\GalaxySetting;
use Galaxy\Core\Library\Concord\ConcordBaseModuleServiceProvider;
use Galaxy\Website\Http\Requests\Admin\Settings\StoreThemeContract;
use Galaxy\Website\Http\Requests\Admin\StoreWebsitePageContract;

class ConcordServiceProvider extends ConcordBaseModuleServiceProvider
{
    protected $modelContracts = [
        \Galaxy\Settings\Contracts\GalaxySetting::class => GalaxySetting::class,
    ];

    protected $requests = [
        StoreThemeContract::class => StoreTheme::class,
        StoreWebsitePageContract::class => StoreWebsitePage::class,
    ];
}
