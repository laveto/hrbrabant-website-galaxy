<?php

namespace App\Modules\WebsiteNews\Services;

use App\Modules\WebsiteNews\Models\WebsiteNews;
use App\Modules\WebsiteNews\Resources\Components\Website\Modules\News\WebsiteController;
use Galaxy\Website\Models\WebsitePageProxy;
use Illuminate\Support\Facades\Schema;

class NewsService
{
    /**
     * Check if given parameter item is within item show config. If that config is an array, then check for active key.
     * Else check if the config is a boolean.
     */
    public static function checkItemShowConfig($config)
    {
        $itemShowConfig = config('website_news.item.show.' . $config, false);

        if (is_array($itemShowConfig)) {
            return $itemShowConfig['active'] ?? false;
        }

        return $itemShowConfig;
    }


    /**
     * Check if given parameter item is within item show config. If that config is an array, then check for active key.
     * Else check if the config is a boolean.
     */
    public static function checkItemShowConfigIsArray($config)
    {
        $itemShowConfig = config('website_news.item.show.' . $config, false);

        return is_array($itemShowConfig);
    }

    public static function showDateOfNewsBasedOnLastUpdate($news)
    {
        $showDate = self::checkItemShowConfig('date');

        $latestNewsItemPublishedOrCreatedAt = self::getLatestNewsItemPublishedOrCreatedAt();

        if ($showDate && self::checkItemShowConfigIsArray('date')) {
            return self::isDateAfterShowUntil($latestNewsItemPublishedOrCreatedAt);
        }

        return $showDate;
    }

    protected static function getLatestNewsItemPublishedOrCreatedAt()
    {
        $latestNewsPublishAt = WebsiteNews::published()
            ->multilanguage()
            ->orderBy('publish_at', 'DESC')
            ->first()
            ?->publish_at;

        $latestNewsCreatedAt = WebsiteNews::published()
            ->multilanguage()
            ->orderBy('created_at', 'DESC')
            ->first()
            ?->created_at;

        // If there is no news with publish_at, return created_at.
        if( !$latestNewsPublishAt ) {
            return $latestNewsCreatedAt;
        }

        return $latestNewsPublishAt->isAfter($latestNewsCreatedAt)
            ? $latestNewsPublishAt
            : $latestNewsCreatedAt;
    }

    public static function showDateOfNews($news)
    {
        $showDate = self::checkItemShowConfig('date');

        if ($showDate && self::checkItemShowConfigIsArray('date')) {
            return self::isDateAfterShowUntil($news->publish_at ?? $news->created_at);
        }

        return $showDate;
    }

    public static function isDateAfterShowUntil($date)
    {
        $showUntil = config('website_news.item.show.date.show_until');

        if ($showUntil) {
            $showUntil = \Carbon\Carbon::parse($showUntil);

            return $date->isAfter($showUntil);
        }

        return false;
    }

    /**
     * Get the ordering expression based on available fields
     */
    public static function getOrderingExpression(): string
    {
        $defaultField = config('website_news.sorting.default', 'date');
        
        // Check if the configured default field exists in the schema
        if (Schema::hasColumn('website_news', $defaultField)) {
            return $defaultField;
        }

        // Fallback to the configured fallback expression
        return config('website_news.sorting.fallback', 'COALESCE(publish_at, created_at)');
    }

    /**
     * Get the ordering direction from config
     */
    public static function getOrderingDirection(): string
    {
        return config('website_news.sorting.direction', 'DESC');
    }

    /**
     * URL of the news index page.
     *
     * Falls back to the website page's slug when the news module's frontend
     * routes aren't registered for the current request (e.g. admin canvas
     * preview, where website route registration is gated on the public domain).
     */
    public static function getIndexUrl(): ?string
    {
        try {
            return action([WebsiteController::class, 'index']);
        } catch (\Throwable $e) {
            return self::getModulePageUrl();
        }
    }

    /**
     * URL of a single news item.
     *
     * Same robustness rules as {@see self::getIndexUrl()} — falls back to the
     * news module page slug + `/{slug}` when frontend module routes aren't
     * registered for the current request. Returns null when the module page is
     * gone entirely so callers can omit the link.
     */
    public static function getShowUrl(WebsiteNews $news): ?string
    {
        try {
            return action([WebsiteController::class, 'show'], ['news' => $news->slug]);
        } catch (\Throwable $e) {
            $base = self::getModulePageUrl();

            return $base ? rtrim($base, '/') . '/' . $news->slug : null;
        }
    }

    /**
     * Resolve the slug-based URL of the WebsitePage that hosts the news module.
     * Looks up tenant-aware first, then globally; returns null when no page
     * carries module_id = 'website_news::news'.
     */
    protected static function getModulePageUrl(): ?string
    {
        $query = WebsitePageProxy::withoutGlobalScopes()
            ->where('module_id', 'website_news::news');

        $websiteId = request()->website()?->id ?? null;

        $page = ($websiteId
            ? (clone $query)->where('website_id', $websiteId)->first()
            : null) ?? $query->first();

        if (!$page) {
            return null;
        }

        $languages = (array) config('core.languages', []);
        $slug = $page->getTranslation('slug', app()->getLocale())
            ?? $page->getTranslation('slug', $languages[0] ?? 'nl');

        return $slug ? '/' . ltrim($slug, '/') : null;
    }
}