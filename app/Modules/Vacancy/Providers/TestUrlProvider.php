<?php

namespace App\Modules\Vacancy\Providers;

use Galaxy\Core\Console\Commands\Concerns\SimpleModuleTestUrlProvider;

class TestUrlProvider extends SimpleModuleTestUrlProvider
{
    public function getProviderName(): string
    {
        return 'Vacancies';
    }

    protected function moduleId(): string
    {
        return 'vacancy::vacancy';
    }

    protected function modelClass(): ?string
    {
        return \App\Modules\Vacancy\Models\Vacancy::class;
    }
}
