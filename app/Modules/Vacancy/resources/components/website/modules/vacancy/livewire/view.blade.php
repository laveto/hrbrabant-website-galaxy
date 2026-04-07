@php( $typeVacancy = $vacancy->vacancyValues->where('unique_key', 'matchCriteria_15')->where('key', '!=', 'value_title')->first() )

<div class='max-w-full px-8 py-10 mx-auto lg:px-0 lg:max-w-4xl'
    data-vacancy-type="{{ $typeVacancy?->value ?: '' }}"
>
    <div class='relative'>
        <div class='text-2xl lg:text-5xl font-bold text-palette-lightblue lg:ml-32 lg:leading-[50px] break-words hyphens-auto'>
            {{ $vacancy->title }}
        </div>
        <div class='lg:absolute left-0 top-0.5 hidden lg:block'>
            <a class='inline-flex items-center justify-center w-10 h-10 border rounded-full border-palette-lightblue text-palette-lightblue hover:bg-palette-lightblue hover:text-white'
                href='{{ action([\App\Modules\Vacancy\Resources\Components\Website\Modules\Vacancy\Controller::class, 'index']) }}#vacancies'>
                <i class='far fa-chevron-left'></i>
            </a>
        </div>
    </div>

    <div class='lg:ml-32'>
        <div class='py-4 text-xl font-semibold lg:text-2xl'>
            {!! $this->getVacancyValue($vacancy, 'textField_description', 'title') !!}
        </div>
        <div class='text-base font-medium text-gray-500'>
            {!! $this->getVacancyValue($vacancy, 'textField_description', 'text') !!}
        </div>

        <div class='py-4 text-xl font-semibold lg:text-2xl'>
            {!! $this->getVacancyValue($vacancy, 'textField_requirements', 'title') !!}
        </div>
        <div class='text-base font-medium text-gray-500'>
            {!! $this->getVacancyValue($vacancy, 'textField_requirements', 'text') !!}
        </div>

        <div class='pt-8 pb-4 text-xl font-semibold lg:text-2xl'>
            {!! $this->getVacancyValue($vacancy, 'textField_companyProfile', 'title') !!}
        </div>
        <div class='text-base font-medium text-gray-500'>
            {!! $this->getVacancyValue($vacancy, 'textField_companyProfile', 'text') !!}
        </div>

        <div class='pt-8 pb-4 text-xl font-semibold lg:text-2xl'>
            {!! $this->getVacancyValue($vacancy, 'textField_salary', 'title') !!}
        </div>
        <div class='text-base font-medium text-gray-500'>
            {!! $this->getVacancyValue($vacancy, 'textField_salary', 'text') !!}
        </div>

        <div class='pt-8 pb-4 text-xl font-semibold lg:text-2xl'>
            Locatie
        </div>
        <div class='text-base font-medium text-gray-500'>
            <i class='mr-2 text-gray-500 far fa-location-dot fa-lg'></i> {{ $vacancy->location }}
        </div>

        <div class='pt-8 pb-4 text-xl font-semibold lg:text-2xl'>
            Contactpersoon
        </div>
        <div class='text-base font-medium text-gray-500'>
            <i class='mr-2 text-gray-500 far fa-user fa-lg'></i> {{ $vacancy->user ?? 'Mascha Scholten' }}
        </div>

        <div class="border-t border-gray-200 my-14"></div>

        <a class='btn-primary-bigger !text-white' href='{{ $vacancy->applyUrl }}' target='_blank'>Solliciteer</a>

        <div class="border-t border-gray-200 my-14"></div>

        <div class='pb-4 text-xl font-semibold lg:text-2xl'>
            Ook interessant
        </div>

        <ul class='arrowList'>
            @forelse($this->getNextVacancies(4) as $nextVacancy)
                <li>
                    <a href='{{ action([\App\Modules\Vacancy\Resources\Components\Website\Modules\Vacancy\Controller::class, 'show'], ['vacancy' => $nextVacancy->slug]) }}'>{{ $nextVacancy->title }}</a>
                </li>
            @empty
                <li>
                    Er zijn geen andere vacatures in dezelfde criteria.
                </li>
            @endforelse
        </ul>
    </div>
</div>
