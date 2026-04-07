@extends('website::admin.websitePages.moduleOptionsLayout')

@section('content')

    <div class="{{ $cssNs }}">

        @if(!config('website_news.index_canvas'))

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="border-b px-4 py-5 sm:px-6 flex items-center text-lg font-bold">
                    <h2 class="card-title">{{ __('Basis informatie') }}</h2>
                </div>

                <div class="px-4 py-5 sm:px-6">

                    @inputValues($websitePage->module_options)

                    @labelFromRequest(\App\Modules\WebsiteNews\Resources\Components\Website\Modules\News\Admin\StoreRequest::class)

                    @input('number', [
                        'name' => 'paginate_amount',
                        'attributes' => [
                            'placeholder' => 10,
                        ],
                    ])

                    @popLabelFromRequest

                </div>

            </div>

        @else

            @include('core::layouts.main.alerts.info', ['message' => 'Deze module is niet te configureren. U kunt gelijk op "Opslaan" klikken.'])

        @endif

    </div>

@endsection
