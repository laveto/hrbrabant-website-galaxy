<?php

namespace App\Modules\Vacancy\Models;

use Galaxy\Website\Models\InvalidatesWebsiteHtmlCache;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\Vacancy\Models\VacancyValue
 *
 * @property int $id
 * @property int $vacancy_id
 * @property string $unique_key
 * @property string|null $key
 * @property string|null $value
 * @property string $value_optimized
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\Vacancy\Models\Vacancy $vacancy
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VacancyValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VacancyValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VacancyValue query()
 * @mixin \Eloquent
 */
class VacancyValue extends Model
{
    use InvalidatesWebsiteHtmlCache;

    protected $guarded = ['id'];

    public function vacancy() {
        return $this->belongsTo(Vacancy::class);
    }
}
