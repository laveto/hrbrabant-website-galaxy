@extends('website::admin.websitePages.moduleOptionsLayout')

@section('content')

    <div class="{{ $cssNs }}">

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="border-b px-4 py-5 sm:px-6 flex items-center text-lg font-bold">
                <h2 class="card-title">{{ __('Basis informatie') }}</h2>
            </div>

            <div class="px-4 py-5 sm:px-6">

                @inputValues($websitePage->module_options)

                @labelFromRequest(\App\Modules\Vacancy\Resources\Components\Website\Modules\Vacancy\Admin\StoreRequest::class)

                @input('number', [
                    'name' => 'vacancy_amount',
                    'value' => 10,
                    'attributes' => [
                        'placeholder' => 10,
                    ],
                ])

                @popLabelFromRequest

            </div>

        </div>

    </div>

@endsection
