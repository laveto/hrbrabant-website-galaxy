<?php

namespace App\Modules\WebsiteNews\Models;

use Galaxy\Core\Models\Concerns\MultilanguageTrait;
use Galaxy\Core\Models\Concerns\SlugTrait;
use Galaxy\Website\Models\ConcernsWebsiteTenant;
use Galaxy\Website\Models\InvalidatesWebsiteHtmlCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Modules\WebsiteNews\Models\WebsiteNewsCategory
 *
 * @property int $id
 * @property int|null $website_id
 * @property array<array-key, mixed> $name
 * @property array<array-key, mixed> $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read mixed $translations
 * @property-read \Galaxy\Website\Models\Website|null $website
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\WebsiteNews\Models\WebsiteNews> $websiteNews
 * @property-read int|null $website_news_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNewsCategory multiLanguage()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNewsCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNewsCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNewsCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNewsCategory whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNewsCategory whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNewsCategory whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNewsCategory whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNewsCategory withoutWebsiteGlobalScope()
 * @mixin \Eloquent
 */
class WebsiteNewsCategory extends Model implements HasMedia
{
    use InvalidatesWebsiteHtmlCache,
        ConcernsWebsiteTenant,
        MultilanguageTrait,
        InteractsWithMedia,
        SlugTrait;

    public array $translatable = [
        'name',
        'slug',
    ];

    public function websiteNews(): HasMany
    {
        return $this->hasMany(WebsiteNews::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        if (!config('website_news.extended')) {
            return;
        }

        // Overwrite default media conversion, so it will generate with responsive images.
        $mediaObject = $this
            ->addMediaConversion('media_library_original')
            ->keepOriginalImageFormat();

        if (!in_array($media->mime_type, ['image/svg', 'image/svg+xml'])) {
            $mediaObject->withResponsiveImages();
        }
    }
}
