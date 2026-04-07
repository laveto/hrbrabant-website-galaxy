<div class="{{ $cssNs }} rounded-2xl flex flex-col gap-2" itemscope itemtype="https://schema.org/Article">

    @if($news->hasMedia() && App\Modules\WebsiteNews\Services\NewsService::checkItemShowConfig('image'))
        <a href="{{ action([\App\Modules\WebsiteNews\Resources\Components\Website\Modules\News\WebsiteController::class, 'show'], ['news' => $news->slug]) }}">
            @media($news, [
                'collection' => 'default',
                'fit' => 'object-cover',
                'class' => 'rounded-2xl object-cover',
                'itemprop' => 'image',
            ])
        </a>
    @endif

    @if(App\Modules\WebsiteNews\Services\NewsService::showDateOfNewsBasedOnLastUpdate($news))
        <div class="text-sm font-medium text-palette-blue" itemprop="datePublished" content="{{ $news->date?->toIso8601String() ?: $news->created_at->toIso8601String() }}">
            {{ $news->date?->isoFormat('D MMMM Y') ?: $news->created_at->isoFormat('D MMMM Y') }}
        </div>
    @endif

    @if(App\Modules\WebsiteNews\Services\NewsService::checkItemShowConfig('author')
        && $news->author
    )
        <div class="text-gray-500">
            {{ __('website_news::translation.by') }}
            <span itemprop="author" itemtype="https://schema.org/Person">{{ $news->author }}</span>
        </div>
    @endif

    @if(App\Modules\WebsiteNews\Services\NewsService::checkItemShowConfig('title'))
        <a href="{{ action([\App\Modules\WebsiteNews\Resources\Components\Website\Modules\News\WebsiteController::class, 'show'], ['news' => $news->slug]) }}">
            <h3 class="font-bold" itemprop="headline">
                {{ $news->title }}
            </h3>
        </a>
    @endif

    @if(App\Modules\WebsiteNews\Services\NewsService::checkItemShowConfig('content'))
        <div class="font-light content" itemprop="description">
            {{ $news->intro }}
        </div>
    @endif

    @if(App\Modules\WebsiteNews\Services\NewsService::checkItemShowConfig('read_more'))
        <a class="btn-primary"
            href="{{ action([\App\Modules\WebsiteNews\Resources\Components\Website\Modules\News\WebsiteController::class, 'show'], ['news' => $news->slug]) }}"
            itemprop="url"
        >
            {{ __('website_news::translation.read_more') }}
        </a>
    @endif

</div>
