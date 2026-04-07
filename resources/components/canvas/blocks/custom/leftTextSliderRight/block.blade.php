@resource([
    '/vendor/swiper/swiper-bundle.min.css',
    '/vendor/swiper/swiper-bundle.min.js',
])

<div @htmlAttrs($htmlAttrs) @canvasBlockAttrs()>

    <div class="container"
        @if (!@$edit && config('canvas.animations.enabled'))
            data-sal="{{ config('canvas.animations.type') }}"
            data-sal-duration="{{ config('canvas.animations.duration') }}"
            data-sal-easing="{{ config('canvas.animations.easing') }}"
        @endif
    >

        {{-- To change gap property: galaxy.common.canvas.left_text_image_right.gap --}}
        <div class="gap-x-8 lg:gap-x-[6rem] gap-y-16 lg:gap-y-8 grid items-center lg:grid-cols-2">

            <div class="column">

                @canvasBlock('canvas::utils.text', [
                    'options' => [
                        'html' => '<p>' . config('canvas.texts.placeholder') . '</p>',
                    ],
                ])

            </div>

            <div class="pt-12 column">

                <div class="relative select-none slider"
                     data-autoplay="{{ @$edit ? 0 : 1 }}"
                     @canvasEditableAttrs([
                        'editor' => 'loop-swiper-LoopEditor',
                        'label' => 'Items',
                        'itemSelector' => '.item',
                    ])
                >

                    <div class="slide-wrapper">
                        @canvasLoop(['items' =>  3])

                            <div class="relative z-10 item"
                                @canvasEditableAttrs([
                                    'editor' => 'loop-swiper-LoopItemEditor',
                                    'label' => 'Item'
                                ])
                            >

                                <div class="overlay absolute inset-0 rounded-[2rem] pointer-events-none opacity-0 transition duration-300 z-10"></div>

                                {{-- To change width/height property: galaxy.common.canvas_media.left_text_image_right.*width* --}}
                                @canvasBlock('canvas::utils.image', [
                                    'class' => 'img-fluid aspect-[1056/850] object-cover rounded-[2rem]',
                                    'placeholder' => '/vendor/galaxy/canvas/img/blocks/common/placeholder.jpg',
                                    'wrapper' => '',
                                    'loading' => 'lazy',
                                    'outputOptions' => [
                                        'width' => 1056,
                                        'height' => 850,
                                    ],
                                ])

                                <div class="absolute bg-gradient-to-b from-transparent inset-0 to-palette-blue top-1/2 via-70% via-palette-blue pointer-events-none"></div>

                                <div class="absolute left-0 right-0 z-30 flex items-center justify-center bottom-1/4">
                                    <div class="flex items-center justify-center gap-2 pt-2 pb-2 pl-2 pr-4 font-semibold bg-white rounded-full text-palette-lightblue hover:bg-opacity-75">
                                        <div class="w-8 aspect-[1] rounded-full bg-palette-lightblue flex justify-center items-center text-white text-xl">
                                            <i class="fas fa-check"></i>
                                        </div>

                                        <div class='sliderBadge'>
                                            @canvasBlock('canvas::utils.text', [
                                                'key' => 'slideBadge',
                                                'options' => [
                                                    'html' => 'Accountmanager',
                                                ],
                                            ])
                                        </div>
                                    </div>
                                </div>

                            </div>

                        @endCanvasLoop
                    </div>

                    @if( $edit ?? false )
                        <span class="absolute z-20 flex items-center justify-center w-12 h-12 ml-4 text-white rounded-full cursor-pointer prev top-1/2 lef-0 bg-palette-blue">
                            <i class="fas fa-angle-left"></i>
                        </span>

                        <span class="absolute right-0 z-20 flex items-center justify-center w-12 h-12 mr-4 text-white rounded-full cursor-pointer next top-1/2 bg-palette-blue">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    @endif
                </div>

            </div>

        </div>

    </div>

</div>
