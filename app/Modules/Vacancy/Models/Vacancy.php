<?php

namespace App\Modules\Vacancy\Models;

use Galaxy\Core\Models\Concerns\SlugTrait;
use Galaxy\Website\Models\InvalidatesWebsiteHtmlCache;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * App\Modules\Vacancy\Models\Vacancy
 *
 * @property int $id
 * @property string $language
 * @property string $referenceNr
 * @property string $title
 * @property string $slug
 * @property string $uid
 * @property \Illuminate\Support\Carbon|null $entryDateTime
 * @property string|null $status
 * @property string|null $user
 * @property string|null $userEmail
 * @property string|null $salaryCurrency
 * @property string|null $salaryValue
 * @property string|null $salaryMin
 * @property string|null $salaryMax
 * @property string|null $salaryUnit
 * @property string|null $location
 * @property string|null $locationAddress
 * @property string|null $locationCity
 * @property string|null $locationState
 * @property string|null $locationCountry
 * @property string|null $locationCountryCode
 * @property string|null $relation
 * @property string|null $relationContact
 * @property int|null $candidatesNeeded
 * @property int|null $hours_min
 * @property int|null $hours_max
 * @property array<array-key, mixed>|null $hours_values
 * @property int|null $published
 * @property \Illuminate\Support\Carbon|null $publicationStartDate
 * @property \Illuminate\Support\Carbon|null $publicationEndDate
 * @property \Illuminate\Support\Carbon|null $publicationFirstDate
 * @property string|null $publicationStatus
 * @property string|null $applyUrl
 * @property string|null $jobUrl
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Vacancy\Models\VacancyValue> $vacancyValues
 * @property-read int|null $vacancy_values_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vacancy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vacancy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vacancy query()
 * @mixin \Eloquent
 */
class Vacancy extends Model
{
    use InvalidatesWebsiteHtmlCache,
        //SlugTrait, // Disabled because somehow it increases the slug everytime.
        Searchable;

    protected $guarded = ['id'];

    protected $casts = [
        'entryDateTime' => 'datetime',
        'publicationStartDate' => 'date',
        'publicationEndDate' => 'date',
        'publicationFirstDate' => 'datetime',
        'hours_min' => 'integer',
        'hours_max' => 'integer',
        'hours_values' => 'array',
    ];

    public function isModelChangeExcluded(): bool
    {
        return true;
    }

    public function vacancyValues() {
        return $this->hasMany(VacancyValue::class);
    }

    public function toSearchableArray()
    {
        return $this->toArray() + [
            'description' => $this->vacancyValues()->where('unique_key', 'textField_description')
                ->where('key', '!=', 'value_title')
                ->get()
                ->pluck('value'),
            'summary' => $this->vacancyValues()->where('unique_key', 'textField_summary')
                ->where('key', '!=', 'value_title')
                ->get()
                ->pluck('value'),
        ];
    }
}
