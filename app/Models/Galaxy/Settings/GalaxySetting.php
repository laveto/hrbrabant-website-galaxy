<?php

namespace App\Models\Galaxy\Settings;

use Galaxy\Tenants\Models\Concerns\ConcernsRelatesToTenant;
use Galaxy\Tenants\Services\SystemTenantService;
use Galaxy\Website\Models\InvalidatesWebsiteHtmlCache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\Galaxy\Settings\GalaxySetting
 *
 * @property int $id
 * @property string|null $tenant_type
 * @property int|null $tenant_id
 * @property string $category
 * @property array<array-key, mixed>|null $settings
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @method static Builder<static>|GalaxySetting forSystemTenant()
 * @method static Builder<static>|GalaxySetting newModelQuery()
 * @method static Builder<static>|GalaxySetting newQuery()
 * @method static Builder<static>|GalaxySetting query()
 * @method static Builder<static>|GalaxySetting tenantWithoutGlobalScope()
 * @mixin \Eloquent
 */
class GalaxySetting extends Model implements HasMedia, \Galaxy\Settings\Contracts\GalaxySetting
{
    use InteractsWithMedia,
        InvalidatesWebsiteHtmlCache,
        ConcernsRelatesToTenant;

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @var string[]
     */
    protected $casts = [
        'settings' => 'array',
    ];

    /**
     * Register media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('settings.website.logo');
        $this->addMediaCollection('settings.website.footer_logo');
        $this->addMediaCollection('settings.mail.logo');

        $this->addMediaCollection('settings.website.footer_image');
    }

    /**
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

    // TODO Critical: Make generic scope?
    public function scopeForSystemTenant(Builder $builder): void
    {
        // Get system tenant.
        $tenant = SystemTenantService::getCurrentTenant();

        // Apply tenant on query.
        $builder->where([
            'tenant_type' => $tenant::class,
            'tenant_id' => $tenant->id,
        ]);
    }

    /**
     * @note We override this relation from ConcernsRelatesToTenant since we would like to use a morph. We cannot know to what settings will be related per app.
     */
    public function getTenantRelation(): MorphTo
    {
        return $this->morphTo('tenant');
    }
}
