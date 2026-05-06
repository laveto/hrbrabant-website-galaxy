<?php

namespace App\Modules\WebsiteNews\Models;

use Galaxy\Canvas\Models\Canvas;
use Galaxy\Core\Models\Concerns\MultilanguageTrait;
use Galaxy\Core\Models\Concerns\PublishedTrait;
use Galaxy\Core\Models\Concerns\SlugTrait;
use Galaxy\Website\Models\ConcernsWebsiteTenant;
use Galaxy\Website\Models\InvalidatesWebsiteHtmlCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Modules\WebsiteNews\Models\WebsiteNews
 *
 * @property int $id
 * @property int|null $website_id
 * @property int|null $website_news_category_id
 * @property array<array-key, mixed> $title
 * @property array<array-key, mixed> $slug
 * @property array<array-key, mixed>|null $intro
 * @property array<array-key, mixed> $content
 * @property array<array-key, mixed>|null $author
 * @property array<array-key, mixed>|null $meta_title
 * @property array<array-key, mixed>|null $meta_description
 * @property \Illuminate\Support\Carbon|null $date
 * @property int $published
 * @property \Illuminate\Support\Carbon|null $publish_at
 * @property \Illuminate\Support\Carbon|null $unpublish_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $canvas_id
 * @property-read Canvas|null $canvas
 * @property-read array $translatable_columns_from
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read mixed $translations
 * @property-read \Galaxy\Website\Models\Website|null $website
 * @property-read \App\Modules\WebsiteNews\Models\WebsiteNewsCategory|null $websiteNewsCategory
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNews multiLanguage()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNews published()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNews query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNews whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNews whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNews whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNews whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteNews withoutWebsiteGlobalScope()
 * @mixin \Eloquent
 */
class WebsiteNews extends Model implements HasMedia
{
    use InvalidatesWebsiteHtmlCache,
        MultilanguageTrait,
        SlugTrait,
        InteractsWithMedia,
        PublishedTrait,
        ConcernsWebsiteTenant;

    public array $translatable = [
        'title',
        'slug',
        'intro',
        'content',
        'author',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'date' => 'date',
        'publish_at' => 'datetime',
        'unpublish_at' => 'datetime',
    ];

    public function canvas(): BelongsTo
    {
        return $this->belongsTo(Canvas::class);
    }

    public function websiteNewsCategory(): BelongsTo
    {
        return $this->belongsTo(WebsiteNewsCategory::class);
    }

    /**
     * Register the conversions that should be performed.
     *
     * @param  Media|null  $media
     */
    public function registerMediaConversions(Media $media = null): void
    {
        // Overwrite default media conversion, so it will generate with responsive images.
        $mediaObject = $this
            ->addMediaConversion('media_library_original')
            ->keepOriginalImageFormat();

        if (!in_array($media->mime_type, ['image/svg', 'image/svg+xml'])) {
            $mediaObject->withResponsiveImages();
        }
    }
}
