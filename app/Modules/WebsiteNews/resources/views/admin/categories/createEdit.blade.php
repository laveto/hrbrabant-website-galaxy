@extends('admin::layouts.layout', [
    'viewCssNs' => $cssNs,
    'title' => 'Categorie ' . (@$category ? ' bewerken' : ' toevoegen'),
    'breadcrumbs' => [
        action([App\Modules\WebsiteNews\Http\Controllers\NewsCategoryController::class, 'index']) => 'Blog categorieën',
    ],
])

@section('content')

    @component('crud::form.index')
        @slot('content')
            @inputValues(@$category)

            <div class="card">

                <div class="card-head">

                    <h2 class="card-title">{{ __('Basisinformatie') }}</h2>

                </div>

                <div class="card-sub">

                    @input('text', [
                        'name' => 'name',
                        'instruction' => __('De naam van het blog categorie.'),
                        'multilanguage' => count(config('core.languages')) > 1,
                    ])

                    @input('slug', [
                        'name' => 'slug',
                        'trigger' => 'name',
                        'instruction' => __('De slug van het blog categorie.'),
                        'multilanguage' => count(config('core.languages')) > 1,
                    ])

                    @if (config('website_news.extended'))
                        @input('image', [
                            'name' => 'image',
                            'instruction' => __('Afbeelding van het blog item'),
                            'required' => false,
                            'outputOptions' => [
                                'width' => config('website_news.image.category.width') ?? 0,
                                'height' => config('website_news.image.category.height') ?? 0,
                            ],
                            'media' => [
                                'model' => @$category,
                                'collectionName' => 'default',
                            ],
                        ])
                    @endif

                </div>
            </div>
        @endslot
    @endcomponent

@endsection
