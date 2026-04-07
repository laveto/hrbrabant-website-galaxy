<div @htmlAttrs($htmlAttrs) @canvasBlockAttrs()>

    <div class="container"
        @if (!@$edit && config('canvas.animations.enabled'))
            data-sal="{{ config('canvas.animations.type') }}"
            data-sal-duration="{{ config('canvas.animations.duration') }}"
            data-sal-easing="{{ config('canvas.animations.easing') }}"
        @endif
    >

        <div class="mb-6 text-center">
            @canvasBlock('canvas::utils.text', [
                'options' => [
                    'html' => '<h3>Wat onze klanten zeggen</h3>',
                ],
            ])
        </div>

        <div class="overflow-hidden">
            <div class="swiper-container relative">
                <div class="swiper-wrapper"
                     @canvasEditableAttrs([
                        'editor' => 'loop-swiper-LoopEditor',
                        'label' => 'Items',
                        'itemSelector' => '.item',
                    ])
                >
                    @canvasLoop(['items' => 2])

                        <div class="item swiper-slide rounded-2xl bg-palette-grayishlighterbue py-4 px-8 lg:px-24 lg:py-14"
                             @canvasEditableAttrs([
                                'editor' => 'loop-swiper-LoopItemEditor',
                                'itemPanel' => 'LoopItemPanel',
                                'label' => 'Item'
                            ])
                        >

                            <div class="flex flex-col items-center text-white px-8">

                                <div class="relative mb-2">
                                    <div class="absolute text-white opacity-25">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="overflow-hidden whitespace-nowrap" style="width: {{ $loopItem->rating ?? '0' }}%;">
                                        <div class="text-white">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>

                                </div>

                                <div class="text-center mb-4">
                                    @canvasBlock('canvas::utils.text', [
                                        'options' => [
                                            'html' => '<p>' . config('canvas.texts.placeholder') . '</p>',
                                        ],
                                    ])
                                </div>

                                <div class="font-semibold">
                                    @canvasBlock('canvas::utils.line', [
                                        'options' => [
                                            'text' => 'Auteur',
                                        ],
                                    ])
                                </div>
                            </div>

                        </div>
                    @endCanvasLoop
                </div>

                <!-- Add navigation buttons -->
                <div class="-translate-y-1/2 absolute bg-white button-prev flex h-8 items-center justify-center ml-4 left-0 rounded-full swiper-button-disabled text-black top-1/2 w-8 z-10">
                    <i class="fas fa-angle-left text-palette-grayishblue"></i>
                </div>

                <div class="-translate-y-1/2 absolute bg-white button-next flex h-8 items-center justify-center mr-4 right-0 rounded-full swiper-button-disabled text-black top-1/2 w-8 z-10">
                    <i class="fas fa-angle-right text-palette-grayishblue"></i>
                </div>
            </div>
    </div>

    </div>

</div>
