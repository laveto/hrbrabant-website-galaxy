<div @htmlAttrs($htmlAttrs)
     @canvasBlockAttrs([
        'label' => 'Blog',
        'panel' => 'BlockPanel'
    ])
>

    <div class="container">

        @php($upcomingNews = App\Modules\WebsiteNews\Models\WebsiteNews::published()
            ->multilanguage()
            ->with('media')
            ->orderBy(\DB::raw(\App\Modules\WebsiteNews\Services\NewsService::getOrderingExpression()), \App\Modules\WebsiteNews\Services\NewsService::getOrderingDirection())
            ->limit(@$canvasBlock->options->pagination)
            ->get()
        )

        <div class="flex flex-wrap items-center justify-between mb-6 gap-x-4">
            <div class="mb-6 font-semibold text-primary">
                @canvasBlock('canvas::utils.text', [
                    'options' => [
                        'html' => '<h3>Laatste blog</h3>',
                    ],
                ])
            </div>

            @php($newsIndexUrl = \App\Modules\WebsiteNews\Services\NewsService::getIndexUrl())
            @if ($newsIndexUrl)
                <a href="{{ $newsIndexUrl }}"
                    class="order-1 mt-4 md:mb-8 btn-black-outline sm:order-none sm:mt-0 btn-primary !py-2.5 !px-5 !rounded-full !font-normal"
                >
                    {{ __('Alle blogs bekijken') }}
                </a>
            @endif

            @if($upcomingNews->isNotEmpty())

                <div class="grid w-full gap-10 md:grid-cols-3">

                    @foreach($upcomingNews as $news)

                        @include('website_news-component::website.modules.news.index.item', ['flip' => $loop->index % 2])

                    @endforeach

                </div>

            @else

                <h2 class="py-10">{{ __('website_news::translation.no_items') }}</h2>

            @endif
        </div>

    </div>

</div>
