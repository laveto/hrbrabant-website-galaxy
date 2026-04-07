<?php

namespace App\Modules\Member\Models;

use Galaxy\Core\Models\Concerns\MultilanguageTrait;
use Galaxy\Core\Models\Concerns\PublishedTrait;
use Galaxy\Core\Models\Concerns\SlugTrait;
use Galaxy\Website\Models\ConcernsWebsiteTenant;
use Galaxy\Website\Models\InvalidatesWebsiteHtmlCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Modules\Member\Models\Member
 *
 * @property int $id
 * @property int|null $website_id
 * @property array<array-key, mixed> $title
 * @property array<array-key, mixed> $subtitle
 * @property array<array-key, mixed> $slug
 * @property array<array-key, mixed> $content
 * @property int $sequence
 * @property string $email
 * @property string $linkedin
 * @property string $whatsapp
 * @property int $published
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array<array-key, mixed>|null $location
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read mixed $translations
 * @property-read \Galaxy\Website\Models\Website|null $website
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member multiLanguage()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member published()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Member withoutWebsiteGlobalScope()
 * @mixin \Eloquent
 */
class Member extends Model implements HasMedia
{
    use InvalidatesWebsiteHtmlCache,
        MultilanguageTrait,
        SlugTrait,
        InteractsWithMedia,
        PublishedTrait,
        ConcernsWebsiteTenant,
        SortableTrait;

    public array $translatable = [
        'title',
        'subtitle',
        'slug',
        'content',
    ];

    public array $sortable = [
        'order_column_name' => 'sequence',
    ];

    protected $casts = [
        'location' => 'array',
    ];

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
