@extends('website::layouts.main', [
    'title' => $websitePage->title_page ?: $websitePage->title_menu,
])

@section('main.content')

    <div class="{{ $cssNs }}">

        @if( config('website_news.index_canvas') )

            <x-canvas::canvas :canvas="$canvas" :canvasVersion="null" tag="website_news_index"/>

        @else

        <div class="container py-4 md:py-12">

            <h1 class="text-3xl font-bold text-palette-blue">{{ $websitePage->title_page ?: $websitePage->title_menu }}</h1>

            @if($upcomingNews->isNotEmpty())

                <div class="grid gap-10 md:grid-cols-3">

                    @foreach($upcomingNews as $news)

                        @include('website_news-component::website.modules.news.index.item')

                    @endforeach

                </div>

            @else

                <h2 class="py-10">{{ __('website_news::translation.no_items') }}</h2>

            @endif

            <div class="py-4 navigation">
                {{ $upcomingNews->withQueryString()->onEachSide(1)->links('website_news-component::website.modules.news.partials.pagination') }}
            </div>

        </div>

        @endif

    </div>

@endsection
