@extends('website::layouts.main', [
    'title' => !empty($news->meta_title) ? $news->meta_title : $news->title,
    'description' => @$news->meta_description,
    'og' => [
        'title' => $news->title,
        'description' => $news->intro,
        'url' => request()->fullUrl(),
        'image' => $news->getFirstMediaUrl(),
    ],
])

@section('main.content')

    <div class="{{ $cssNs }}" itemscope itemtype="https://schema.org/NewsArticle">

        <div class="container py-4 md:py-12">

            <div class="mb-8">
                <a class="px-4 py-2.5 font-normal border border-palette-blue rounded-xl text-palette-blue inline-block hover:bg-palette-blue hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-palette-blue"
                    href="{{ action([\App\Modules\WebsiteNews\Resources\Components\Website\Modules\News\WebsiteController::class, 'index']) }}"
                >
                    <i class="mr-2 fas fa-chevron-left"></i> {{ __('Terug') }}
                </a>
            </div>

            <div class="mb-2 text-palette-blue" itemprop="datePublished" content="{{ $news->date->toIso8601String() }}">
                {{ $news->date->isoFormat('D MMMM Y') }}
            </div>

            <h1 class="font-semibold text-palette-blue" itemprop="headline">{{ $news->title }}</h1>

            @if($news->author)
            <div class="my-4 text-gray-500">
                {{ __('website_news::translation.by') }}
                <span itemprop="author" itemtype="https://schema.org/Person">{{ $news->author }}</span>
            </div>
            @endif

            @media($news, [
                'collection' => 'default',
                'fit' => 'object-cover',
                'class' => 'w-full rounded-xl',
                'itemprop' => 'image',
            ])
        </div>

        @if (config('website_news.show_canvas'))
            <div itemprop="articleBody">
                <x-canvas::canvas :canvas="$news->canvas" :canvasVersion="null" :tag="null" />
            </div>
        @else
            <div class="container flex flex-col items-center justify-center py-10 sm:py-20">
                <div class="pt-4 md:pt-16">
                    <div class="px-5 py-4 bg-white shadow-md newsItem rounded-b-3xl sm:py-12 md:-mx-14 md:px-20">
                        <div
                            class="{{ $news->hasMedia() ? 'lg:grid-cols-2' : '' }} mt-5 grid grid-cols-1 place-content-start gap-8">

                            <div class="content">

                                <h1 class="mt-4 text-3xl sm:text-6xl" itemprop="headline">{{ $news->title }}</h1>

                                <p class="pb-10 text-xl font-semibold text-gray-500" itemprop="description">{{ $news->intro }}</p>

                                <div class="mb-10" itemprop="articleBody">
                                    {!! $news->content !!}
                                </div>

                                <a class="inline-block btn-primary"
                                    href="{{ action([\App\Modules\WebsiteNews\Resources\Components\Website\Modules\News\WebsiteController::class, 'index']) }}">
                                    {{ __('website_news::translation.all_news') }}
                                </a>

                            </div>

                            @if ($news->hasMedia())
                                <div class="w-full imageItem">

                                    @media($news, [
                                        'collection' => 'default',
                                        'fit' => 'object-cover',
                                        'class' => 'w-full rounded-3xl',
                                        'itemprop' => 'image',
                                    ])

                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
