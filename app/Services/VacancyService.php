<?php

namespace App\Services;

use App\Modules\Vacancy\Models\Vacancy;

class VacancyService
{
    public static function getVacancyValue(Vacancy $vacancy, string $uniqueKey, ?string $key = null) {
        return $vacancy->vacancyValues
            ->where('unique_key', $uniqueKey)
            ->where('key', $key)
            ->first()->value ?? null;
    }
}
