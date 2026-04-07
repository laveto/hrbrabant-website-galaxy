@extends('admin::layouts.layout', [
    'viewCssNs' => $cssNs,
    'title' => 'Blog ' . (@$blog ? ' bewerken' : ' toevoegen'),
    'breadcrumbs' => [
        action([App\Modules\WebsiteNews\Http\Controllers\NewsController::class, 'index']) => 'Blog',
    ],
])

@section('content')

    @component('crud::form.index')
        @slot('content')
            @inputValues(@$blog)
            @labelFromRequest(\App\Modules\WebsiteNews\Http\Requests\StoreNews::class)

            <div class="card">

                <div class="card-head">

                    <h2 class="card-title">
                        {{ __('Algemene informatie') }}
                    </h2>

                </div>

                <div class="card-sub">

                    @if( config('website_news.category.active') )
                        @input('select', [
                            'name' => 'website_news_category_id',
                            'label' => 'category',
                            'instruction' => __('Categorie van het blog item'),
                            'values' => App\Modules\WebsiteNews\Models\WebsiteNewsCategory::all(),
                        ])
                    @endif

                    @input('text', [
                        'name' => 'title',
                        'instruction' => __('Titel van het blog item'),
                        'multilanguage' => count(config('core.languages')) > 1,
                    ])

                    @input('slug', [
                        'name' => 'slug',
                        'trigger' => 'title',
                        'instruction' => __('Url van het blog item'),
                        'multilanguage' => count(config('core.languages')) > 1,
                    ])

                    {{--
                    @input('text', [
                        'name' => 'intro',
                        'instruction' => __('Intro tekst van het blog item'),
                        'multilanguage' => count(config('core.languages')) > 1,
                    ])
                    --}}

                    @if (!config('website_news.show_canvas'))
                        @input('richtext', [
                            'name' => 'content',
                            'instruction' => __('Lange beschrijving van het blog item'),
                            'multilanguage' => count(config('core.languages')) > 1,
                        ])
                    @endif

                    @input('date', [
                        'name' => 'date',
                        'instruction' => __('Datum van het blog item'),
                        'required' => true,
                        'value' => now()->format('Y-m-d'),
                    ])

                    @input('image', [
                        'name' => 'image',
                        'instruction' => __('Afbeelding van het blog item'),
                        'required' => false,
                        'outputOptions' => [
                            'width' => config('website_news.image.news.width') ?? 0,
                            'height' => config('website_news.image.news.height') ?? 0,
                        ],
                        'media' => [
                            'model' => @$blog,
                            'collectionName' => 'default',
                        ],
                    ])

                </div>

            </div>

            <div class="card">

                <div class="card-head">

                    <h2 class="card-title">
                        {{ __('Meta data') }}
                    </h2>

                </div>

                <div class="card-sub">

                    @input('text', [
                        'name' => 'meta_title',
                        'instruction' => __('Titel van het blogitem zoals opgenomen in de broncode en weergegeven in de titelbalk van je browser'),
                        'multilanguage' => count(config('core.languages')) > 1,
                        'required' => false,
                    ])

                    @input('text', [
                        'name' => 'meta_description',
                        'instruction' => __('Beschrijving van het blogitem die in de broncode is opgenomen'),
                        'multilanguage' => count(config('core.languages')) > 1,
                        'required' => false,
                    ])

                </div>

            </div>

            <div class="card">

                <div class="card-head">

                    <h2 class="card-title">
                        {{ __('Publicatie informatie') }}
                    </h2>

                </div>

                <div class="card-sub">

                    @if (config('website_news.extended'))
                        @input('text', [
                            'name' => 'author',
                            'instruction' => __('Persoon die het blog item gepubliceerd heeft'),
                            'required' => false,
                            'multilanguage' => count(config('core.languages')) > 1,
                        ])
                    @endif

                    @input('switch', [
                        'name' => 'published',
                        'instruction' => __('Geeft aan of het blog item online staat of niet'),
                        'value' => 1,
                    ])

                    @if (config('website_news.extended'))
                        @input('date', [
                            'name' => 'publish_at',
                            'instruction' => __('Datum wanneer het blog item gepubliceerd wordt'),
                            'required' => false,
                        ])

                        @input('date', [
                            'name' => 'unpublish_at',
                            'instruction' => __('Datum wanneer het blog item gedepubliceerd wordt'),
                            'required' => false,
                        ])
                    @endif

                </div>

            </div>
        @endslot
    @endcomponent

    @if (config('website_news.show_canvas'))
        @include('canvas::editor', [
            'title' => __('Canvas'),
            'instruction' => __('Pas aan welke canvas blokken getoond worden op het blog item pagina.'),
            'canvas' => \Galaxy\Canvas\Actions\GetCanvas::run('website_news', @$blog),
        ])
    @endif

@endsection
