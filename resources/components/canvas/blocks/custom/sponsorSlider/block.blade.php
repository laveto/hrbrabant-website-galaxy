@resource([
    '/vendor/swiper/swiper-bundle.min.css',
    '/vendor/swiper/swiper-bundle.min.js',
    '/vendor/owl.carousel/dist/owl.carousel.min.js',
    '/vendor/owl.carousel/dist/assets/owl.carousel.min.css',
])

<div @htmlAttrs($htmlAttrs) @canvasBlockAttrs()>

    <div class="container overflow-x-hidden"
        @if (!@$edit && config('canvas.animations.enabled'))
            data-sal="{{ config('canvas.animations.type') }}"
            data-sal-duration="{{ config('canvas.animations.duration') }}"
            data-sal-easing="{{ config('canvas.animations.easing') }}"
        @endif
    >
        <div class="flex items-center justify-center mb-6">
            <h4 class="mb-8 lg:mb-12">
                @canvasBlock('canvas::utils.line', [
                    'options' => [
                        'text' => 'Onze opdrachtgevers',
                    ],
                ])
            </h4>
        </div>


        <div class="relative slider">

            @if(!($edit ?? false))
                <div class="absolute inset-0 z-10 w-full pointer-events-none bg-gradient-to-r from-white via-transparent to-white"></div>
            @endif

            <div class="owl-carousel owl-theme"
                 data-autoplay="{{ @$edit ? 0 : 1 }}"
                 data-edit="{{ @$edit ? 1 : 0 }}"
                 @canvasEditableAttrs([
                    'editor' => 'loop-owlCarousel-LoopEditor',
                    'label' => 'Items',
                    'itemSelector' => '.item',
                ])
            >
                @canvasLoop(['items' =>  8])

                    <div class="item"
                        @canvasEditableAttrs([
                            'editor' => 'loop-owlCarousel-LoopItemEditor',
                            'itemPanel' => 'LoopItemPanel',
                            'label' => 'Item'
                        ])
                    >

                        {{-- To change width/height property: galaxy.common.canvas_media.left_text_image_right.*width* --}}
                        @canvasBlock('canvas::utils.image', [
                            'class' => 'img-fluid aspect-[4/2] md:aspect-[7/2] object-contain',
                            'placeholder' => '/vendor/galaxy/canvas/img/blocks/common/placeholder.jpg',
                            'wrapper' => '',
                        ])

                    </div>

                @endCanvasLoop
            </div>

            <!-- Add navigation buttons -->
            @if( $edit ?? false)
                <button class="owl-prev" aria-label="Vorige">
                    <i class="fas fa-angle-left"></i>
                </button>
                <button class="owl-next" aria-label="Volgende">
                    <i class="fas fa-angle-right"></i>
                </button>
            @endif

        </div>

    </div>

</div>
