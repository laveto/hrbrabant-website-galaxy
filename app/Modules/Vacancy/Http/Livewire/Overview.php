<?php

namespace App\Modules\Vacancy\Http\Livewire;

use App\Modules\Vacancy\Models\Vacancy;
use Galaxy\Website\Models\WebsitePage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class Overview extends Component
{
    use WithPagination;

    public WebsitePage $websitePage;
    public int $vacancyCount = 0;
    public array $filter = [];
    public $page;
    public $query;
    public ?int $hoursMin = null;
    public ?int $hoursMax = null;

    public const HOURS_RANGE_MIN = 0;
    public const HOURS_RANGE_MAX = 40;

    protected $queryString = [
        'page' => ['except' => 1],
        'filter' => ['except' => []],
        'query' => ['except' => ''],
        'hoursMin' => ['except' => null],
        'hoursMax' => ['except' => null],
    ];

    public function render()
    {
        // @Ugly: return json instead of Livewire. This is used to get filtered data for vacancy page component.
        if (request()->get('json') && in_array(request()->ip(), ['92.66.177.117', '82.176.159.45', '127.0.0.1', '104.248.90.17'])) {
            ob_end_clean();
            return die($this->buildVacancyQuery()->pluck('referenceNr'));
        }
        
        return view('vacancy-component::website.modules.vacancy.livewire.overview', [
            'vacancies' => $this->getPaginatedVacancies(),
        ])->layout('website::layouts.main');
    }

    public function mount() {
        // Encode subkey values from $this->filter
        // to URL-safe values
        foreach ($this->filter as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $subKey => $subValue) {
                    $encodedSubKey= $this->getEncodedValue($subKey);
                    $this->filter[$key][$encodedSubKey] = $subValue;

                    if( $subKey !== $encodedSubKey) {
                        // Remove the original key
                        unset($this->filter[$key][$subKey]);
                    }
                }
            }
        }

        $this->setVacancyCount($this->buildVacancyQuery());
    }

    protected function getEncodedValue($value) {
        return rawurlencode($value);
    }

    protected function getDecodedValue($value) {
        return rawurldecode($value);
    }

    public function buildVacancyQuery($applyConditions = true) {
        $query = Vacancy::with('vacancyValues');

        if($applyConditions) {
            // Apply filter
            $this->applyFilterConditions($query);

            // Apply hours range filter
            $this->applyHoursFilter($query);

            // Apply search conditions
            $this->applySearchConditions($query);
        }

        return $query->orderBy('publicationStartDate', 'desc');
    }

    protected function applyHoursFilter($query): void
    {
        if (! $this->isHoursFilterActive()) {
            return;
        }

        $min = $this->hoursMin ?? self::HOURS_RANGE_MIN;
        $max = $this->hoursMax ?? self::HOURS_RANGE_MAX;

        // SQL coarse pass — overlap test on min/max columns.
        $query->whereNotNull('hours_min')
            ->whereNotNull('hours_max')
            ->where('hours_min', '<=', $max)
            ->where('hours_max', '>=', $min);

        // Discrete refinement — vacancies with a discrete hours_values list must
        // contain at least one value inside [min, max]. Fetch IDs that need to be
        // excluded and add a whereNotIn so pagination counts stay correct.
        $excludedIds = (clone $query)
            ->whereNotNull('hours_values')
            ->get(['id', 'hours_values'])
            ->reject(fn ($v) => $this->discreteValuesIntersect($v->hours_values, $min, $max))
            ->pluck('id')
            ->all();

        if (! empty($excludedIds)) {
            $query->whereNotIn('id', $excludedIds);
        }
    }

    protected function isHoursFilterActive(): bool
    {
        return $this->hoursMin !== null || $this->hoursMax !== null;
    }

    protected function discreteValuesIntersect(?array $values, int $min, int $max): bool
    {
        if (empty($values)) {
            return false;
        }

        foreach ($values as $value) {
            if ($value >= $min && $value <= $max) {
                return true;
            }
        }

        return false;
    }

    protected function applyFilterConditions($query)
    {
        if (!empty($this->filter)) {
            foreach ($this->filter as $uniqueKey => $filter) {
                // Skip if the filter is empty because livewire migth somehow not accept it
                if(!$filter) {
                    continue;
                }

                // Convert URL-safe keys back to original values
                $originalValues = collect(array_keys($filter))
                    ->map(function ($value) {
                        return $this->getDecodedValue($value);
                    })
                    ->all();

                $query->whereHas('vacancyValues', function($query) use ($uniqueKey, $originalValues) {
                    $query->where('unique_key', $uniqueKey)
                        ->whereIn('value_optimized', $originalValues)
                        ->where('key', '!=', 'value_title');
                });
            }
        }
    }

    protected function applySearchConditions($query)
    {
        if ($this->query) {
            $vacancyIDs = Vacancy::search($this->query)
                ->query(fn($q) => $query)
                ->get()
                ->pluck('id');

            $query->whereIn('id', $vacancyIDs);
            // $query->where(function($query) use ($searchQuery) {
            //     $query->where('title', 'like', '%' . $searchQuery . '%')
            //         ->orWhereHas('vacancyValues', function($query) use ($searchQuery) {
            //             $query->where(function($q) use ($searchQuery) {
            //                 $q->where('unique_key', 'textField_description')
            //                     ->where('value', 'like', '%' . $searchQuery . '%')
            //                     ->where('key', '!=', 'value_title');
            //             })->orWhere(function($q) use ($searchQuery) {
            //                 $q->where('unique_key', 'textField_summary')
            //                     ->where('value', 'like', '%' . $searchQuery . '%')
            //                     ->where('key', '!=', 'value_title');
            //             });
            //         });
            // });
        }
    }

    public function getPaginatedVacancies() {
        $query = $this->buildVacancyQuery();

        return $query
            ->paginate($this->websitePage->module_options['vacancy_amount'] ?? 6)
            ->appends(['filter' => $this->filter, 'query' => $this->query]);
    }

    public function updatedFilter($value, $keyPath)
    {
        $keys = explode('.', $keyPath);

        if (count($keys) >= 2 && str_starts_with($keys[0], 'matchCriteria_')) {
            $category = $keys[0];
            $originalValue = $keys[1];
            // $safeValue = $this->getDecodedValue($originalValue);

            // dd($category, $originalValue, $originalValue);
            if ($value === false) {
                data_forget($this->filter, "{$category}.{$originalValue}");

                // 👇 if the category is now empty, remove it entirely
                if (empty($this->filter[$category] ?? [])) {
                    unset($this->filter[$category]);
                }
            } else {
                data_set($this->filter, "{$category}.{$originalValue}", $value);
                // data_forget($this->filter, "{$category}.{$originalValue}");
            }
        }

        // 💡 important: recalculate count after filter update
        $this->setVacancyCount($this->buildVacancyQuery());
    }

    #[Computed]
    public function allVacancyValues()
    {
        $vacancyResult = $this->buildVacancyQuery(false)->get();

        return $vacancyResult->pluck('vacancyValues')->flatten()->unique('value');
    }

    #[Computed]
    public function vacancyValues()
    {
        $vacancyResult = $this->buildVacancyQuery()->get();

        return $vacancyResult->pluck('vacancyValues')->flatten()->unique('value');
    }

    #[Computed]
    public function filterCount()
    {
        $vacancyResult = $this->buildVacancyQuery()->get();

        return $vacancyResult->pluck('vacancyValues')->flatten()->countBy('value');
    }

    #[Computed]
    public function matchCriteriaFilters() {
        return [
            'matchCriteria_6',
            'matchCriteria_10',
            'matchCriteria_12',
        ];
    }

    public function getVacancyValue(Vacancy $vacancy, string $uniqueKey, ?string $key = null) {
        return $vacancy->vacancyValues
            ->where('unique_key', $uniqueKey)
            ->where('key', $key)
            ->first()
            ->value 
            ?? null;
    }

    public function setVacancyCount($query) {
        $this->vacancyCount = $query->count();
    }

    public function resetFilter() {
        $this->reset('filter');
        $this->hoursMin = null;
        $this->hoursMax = null;

        $this->resetPage();

        $this->setVacancyCount($this->buildVacancyQuery());
        $this->dispatch('hours-reset');
    }

    public function setHoursRange(?int $min, ?int $max): void
    {
        $this->hoursMin = $min;
        $this->hoursMax = $max;

        $this->resetPage();
        $this->setVacancyCount($this->buildVacancyQuery());
    }

    public function updatedHoursMin(): void
    {
        $this->setVacancyCount($this->buildVacancyQuery());
    }

    public function updatedHoursMax(): void
    {
        $this->setVacancyCount($this->buildVacancyQuery());
    }

    public function clearHoursFilter(): void
    {
        $this->hoursMin = null;
        $this->hoursMax = null;
        $this->resetPage();
        $this->setVacancyCount($this->buildVacancyQuery());
    }

    public function checkInFilter($category, $value)
    {
        $safeValue = $this->getEncodedValue($value);
        
        // Check if the safe value exists in the filter
        return data_get($this->filter, "{$category}.{$safeValue}", false) 
            || data_get($this->filter, "{$category}.{$value}", false);
    }

    public function getVacancyColor($vacancy)
    {
        $criteria = $vacancy
            ->vacancyValues
            ->where('unique_key', 'matchCriteria_15')
            ->where('key', '!=', 'value_title');

        $color = 'text-palette-lightblue';
        $background = 'bg-palette-lightblue';

        if ($criteria->contains('value', 'Werving en Selectie')) {
            $color = 'text-palette-green';
            $background = 'bg-palette-green';
        } elseif ($criteria->contains('value', 'Uitzenden')) {
            $color = 'text-palette-orange';
            $background = 'bg-palette-orange';
        }

        return [
            'color' => $color,
            'background' => $background,
        ];
    }
}
