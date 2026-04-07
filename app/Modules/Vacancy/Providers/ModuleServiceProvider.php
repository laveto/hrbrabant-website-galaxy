<?php

namespace App\Modules\Vacancy\Providers;

use App\Modules\Vacancy\Console\Commands\SyncVacancies;
use App\Modules\Vacancy\Http\Livewire\Overview;
use App\Modules\Vacancy\Http\Livewire\View;
use Galaxy\Core\Contracts\ProvidesTestUrls;
use Galaxy\Core\Library\Concord\ConcordBaseModuleServiceProvider;

class ModuleServiceProvider extends ConcordBaseModuleServiceProvider
{
    public function register()
    {
        parent::register();

        $this->app->tag(TestUrlProvider::class, ProvidesTestUrls::class);

        $this->registerCommands();
    }

    public function boot()
    {
        parent::boot();

        \Livewire::component('vacancy.overview', Overview::class);
        \Livewire::component('vacancy.view', View::class);
    }

    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SyncVacancies::class,
            ]);
        }
    }
}
