<?php

namespace App\Modules\Vacancy\Providers;

use App\Modules\Vacancy\Models\Vacancy;
use Galaxy\Core\Console\Commands\Concerns\SimpleModuleTestUrlProvider;
use Galaxy\Website\Models\WebsitePageProxy;
use Illuminate\Database\Eloquent\Model;

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
        return Vacancy::class;
    }

    public function getTestUrls(string $baseUrl, string $language, int $limit = 3): array
    {
        $page = WebsitePageProxy::modelClass()::query()
            ->withoutGlobalScopes()
            ->where('published', true)
            ->where('module_id', $this->moduleId())
            ->first();

        if (! $page) {
            return [];
        }

        $pageSlug = $page->getTranslation('slug', $language);

        if ($pageSlug === null) {
            return [];
        }

        $prefix = rtrim($baseUrl, '/') . '/' . ltrim($pageSlug, '/');
        $groups = [['label' => 'Overview', 'urls' => [$prefix]]];

        $items = Vacancy::query()
            ->withoutGlobalScopes()
            ->where('published', 1)
            ->whereNotNull('slug')
            ->inRandomOrder()
            ->limit($limit)
            ->get();

        if ($items->isNotEmpty()) {
            $groups[] = [
                'label' => 'Detail',
                'urls' => $items->map(fn (Model $item) => $prefix . '/' . $item->slug)->all(),
            ];
        }

        return $groups;
    }
}
