<?php

namespace App\Modules\Vacancy\Http\Livewire;

use App\Modules\Vacancy\Models\Vacancy;
use Galaxy\Website\Models\WebsitePage;
use Livewire\Component;
use Livewire\WithPagination;

class View extends Component
{
    use WithPagination;

    public WebsitePage $websitePage;
    public Vacancy $vacancy;

    public function render()
    {
        return view('vacancy-component::website.modules.vacancy.livewire.view')
            ->layout('website::layouts.main');
    }

    public function getVacancyValue(Vacancy $vacancy, string $uniqueKey, ?string $key = null) {
        return $vacancy->vacancyValues
            ->where('unique_key', $uniqueKey)
            ->where('key', $key)
            ->first()->value ?? null;
    }

    public function getNextVacancies($amount) {
        $currentVacancy = $this->vacancy;

        // Get the values needed
        $criteriaValues = $currentVacancy->vacancyValues()
            ->where('unique_key', 'matchCriteria_6') // _6 = functiegroep
            ->where('key', '!=', 'value_title')
            ->pluck('value');

        $allVacancies = Vacancy::with('vacancyValues')
            ->where('id', '!=', $currentVacancy->id) // Filter the same one to be not included
            ->whereHas('vacancyValues', function($query) use ($criteriaValues) {
                $query->where('unique_key', 'matchCriteria_6')
                    ->where('key', '!=', 'value_title')
                    ->whereIn('value', $criteriaValues);
            })
            ->get();

        // @note; als ze een volledige match willen deze code gebruiken.
//        $allVacancies = Vacancy::with('vacancyValues')
//            ->whereHas('vacancyValues', function($query) use ($criteriaValues) {
//                $query->where('unique_key', 'matchCriteria_6')
//                    ->where('key', '!=', 'value_title')
//                    ->whereIn('value', $criteriaValues);
//            })
//            ->whereDoesntHave('vacancyValues', function($query) use ($criteriaValues) {
//                $query->where('unique_key', 'matchCriteria_6')
//                    ->where('key', '!=', 'value_title')
//                    ->whereNotIn('value', $criteriaValues);
//            })
//            ->get();

        $actualAmount = $allVacancies->count() < 4 ? $allVacancies->count() : $amount;

        return $allVacancies->random($actualAmount);
    }
}
