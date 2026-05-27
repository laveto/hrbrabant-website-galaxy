@resource([
    '/vendor/swiper/swiper-bundle.min.css',
    '/vendor/swiper/swiper-bundle.min.js',
])

<div @htmlAttrs($htmlAttrs) @canvasBlockAttrs()>

    <div class="py-1 overflow-x-hidden">
        <div class="container flex flex-col flex-wrap items-start gap-8 mb-6 md:flex-row"
            @if (!@$edit && config('canvas.animations.enabled'))
                data-sal="{{ config('canvas.animations.type') }}"
                data-sal-duration="{{ config('canvas.animations.duration') }}"
                data-sal-easing="{{ config('canvas.animations.easing') }}"
            @endif
        >
            <div class="pr-4 mb-0 text-white">
                @canvasBlock('canvas::utils.text', [
                    'options' => [
                        'html' => '<span class="h2">Vacatures</span>',
                    ],
                ])
            </div>

            @canvasBlock('canvas::utils.button', [
                'class' => 'bg-[#B54B46] px-5 py-2 text-white hover:bg-opacity-75 rounded-full inline-block order-2 md:order-none md:ml-auto',
            ])

            <div class="relative w-full swiper-container">

                <?php
                    $amount = count((array)@$canvasBlock->options->loops->loop->items ?: []) ?: 5;
                    $items = \App\Modules\Vacancy\Models\Vacancy::with('vacancyValues')->orderBy('publicationStartDate', 'desc')
                        ->when(isset($canvasBlock->options->vacancies) && str_starts_with($canvasBlock->options->vacancies, 'https://hrbrabant.nl/vacatures?filter'), function($query) use ($canvasBlock, $edit) {

                            // In the canvas editor we re-render the whole page on every save.
                            // Hitting hrbrabant.nl synchronously here used to push save time to
                            // ~20s when the cache was cold or the upstream was slow. The editor
                            // preview doesn't need filtered results — fall back to "all vacancies".
                            if (@$edit) {
                                return;
                            }

                            $data = Cache::remember('blocks.custom.vacancySlider.'.$canvasBlock->id.'filter-url', 600, function() use ($canvasBlock) {
                                try {
                                    $response = Http::timeout(3)
                                        ->connectTimeout(2)
                                        ->get($canvasBlock->options->vacancies.'&json=true');

                                    return $response->successful() ? $response->json() : [];
                                } catch (\Throwable $e) {
                                    report($e);
                                    return [];
                                }
                            });

                            $query->whereIn('referenceNr', $data ?: []);
                        })
                        ->when(!empty($canvasBlock->options->vacancies) && !str_starts_with($canvasBlock->options->vacancies, 'https://hrbrabant.nl/vacatures?filter'), function ($query) use ($canvasBlock) {
                            $query->whereIn('referenceNr', explode(',', $canvasBlock->options->vacancies));
                        })
                        ->limit($amount)
                        ->get();
                ?>

                @if( $items->isEmpty() )

                <div class="swiper-wrapper">
                    <div class="flex gap-2 flex-col items-center justify-center w-full p-8 min-h-[20rem] text-center text-white bg-palette-grayishblue rounded-2xl">
                        {{ __('Momenteel zijn er geen vacatures beschikbaar') }}

                        <a href="{{ action([\App\Modules\Vacancy\Resources\Components\Website\Modules\Vacancy\Controller::class, 'index']) }}"
                            class="px-8 py-3 mt-4 text-white rounded btn bg-palette-lightblue hover:bg-palette-blue"
                        >
                            {{ __('Bekijk alle vacatures') }}
                        </a>
                    </div>
                </div>

                @else

                    <div class="swiper-wrapper"
                        @canvasEditableAttrs([
                            'editor' => 'loop-swiper-LoopEditor',
                            'label' => 'Items',
                            'itemSelector' => '.item',
                        ])
                    >
                        @php($index = 0)
                        @canvasLoop(['items' =>  5])

                            @continue(!$item = @$items[$index])
                            <div class="h-auto item swiper-slide"
                                @canvasEditableAttrs([
                                    'editor' => 'loop-swiper-LoopItemEditor',
                                    'label' => 'Item'
                                ])
                            >

                                <?php
                                    $color = ($criteria = $item->vacancyValues->where('unique_key', 'matchCriteria_15'))->contains('value', 'Werving en Selectie')
                                        ? 'text-palette-green' : ($criteria->contains('value', 'Uitzenden') ? 'text-palette-orange' : '');
                                    $background = ($criteria = $item->vacancyValues->where('unique_key', 'matchCriteria_15'))->contains('value', 'Werving en Selectie')
                                        ? 'bg-palette-green' : ($criteria->contains('value', 'Uitzenden') ? 'bg-palette-orange' : '');
                                ?>
                                <div class="flex flex-col h-full p-4 bg-white rounded-2xl md:p-8">
                                    <div class="mb-4 text-lg font-semibold title {{ $color }}">
                                        @if( $color == 'text-palette-green')
                                            <img class='inline-block w-8 mr-2 [transform:_translate3d(0,0,0)]' src='/img/website/groen_logo.svg' alt='Groen HR Brabant logo'>
                                        @elseif( $color == 'text-palette-orange')
                                            <img class='inline-block w-8 mr-2 [transform:_translate3d(0,0,0)]' src='/img/website/oranje_logo.svg' alt='Oranje HR Brabant logo'>
                                        @endif

                                        {{ $item->title }}
                                    </div>

                                    <div class="text-sm font-medium description">
                                        {!! \App\Services\VacancyService::getVacancyValue($item, 'textField_summary', 'text') !!}
                                    </div>

                                    <div class="flex flex-col gap-4 pt-4 mt-auto xl:flex-row xl:items-center">
                                        <div class="flex items-center {{ $color }}">
                                            <i class="mr-3 fa-2x far fa-location-dot"></i>
                                            <span class="font-medium">{{ $item->locationCity }}</span>
                                        </div>

                                        <div class="xl:ml-auto">
                                            <a class="block font-medium px-8 py-3 text-white rounded btn {{ $background ? $background . ' hover:bg-opacity-75' : 'bg-palette-lightblue hover:bg-palette-blue' }}"
                                                href="{{ action([\App\Modules\Vacancy\Resources\Components\Website\Modules\Vacancy\Controller::class, 'show'], ['vacancy' => $item]) }}"
                                            >
                                                {{ __('Bekijk vacature') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            @php(++$index)
                        @endCanvasLoop
                    </div>

                    <div class="flex justify-center gap-4 mt-4">
                        <!-- If we need navigation buttons -->
                        <div class="inline-flex items-center justify-center w-10 h-10 bg-white rounded-full button-prev hover:bg-opacity-75">
                            <i class="fas fa-angle-left"></i>
                        </div>
                        <div class="inline-flex items-center justify-center w-10 h-10 bg-white rounded-full button-next hover:bg-opacity-75">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>

</div>
