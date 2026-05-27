<div @htmlAttrs($htmlAttrs) @canvasBlockAttrs()>

    <div class="{{ ($canvasBlock->options->container ?? true) ? 'container' : 'px-4' }}">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-{{ $canvasBlock->options->columnsCount ?? 3 }} gap-4 lg:gap-12 justify-center items-center"
            @canvasEditableAttrs([
                'editor' => 'loop-LoopEditor',
                'loopPanel' => 'LoopPanel',
                'label' => 'Items',
                'itemSelector' => '.item',
            ])>

            <?php
$aspectRatio = ($canvasBlock->options->aspect_ratio ?? 'aspect-[16/9]');
$widthHeight = match (true) {
    $aspectRatio === 'aspect-[1]' => ['width' => 600, 'height' => 600],
    $aspectRatio === 'aspect-[7/5]' => ['width' => 840, 'height' => 600],
    $aspectRatio === 'aspect-[384/200]' => ['width' => 1152, 'height' => 600],
    //$aspectRatio === 'aspect-[5/4]' => ['width' => 750, 'height' => 857],
    default => ['width' => 1152, 'height' => 600],
}
            ?>

            @canvasLoop(['items' => 3])

            <div class="h-full item" @canvasEditableAttrs(['editor' => 'loop-LoopItemEditor', 'label' => 'Item', 'itemPanel' => 'LoopItemPanel'])>

                <div class="relative {{ $canvasBlock->options->rounded ?? '' }} overflow-hidden">
                    @canvasBlock('canvas::utils.image', [
                        'key' => 'card-icon',
                        'class' => implode(' ', ['object-cover', ($canvasBlock->options->aspect_ratio ?? 'aspect-[16/9]')]),
                        'placeholder' => '/vendor/galaxy/admin/img/common/placeholder.png',
                        'outputOptions' => [
                            'width' => $widthHeight['width'],
                            'height' => $widthHeight['height'],
                        ],
                        'wrapper' => '',
                    ])

                    <div
                        class="absolute inset-0 z-10 flex items-center justify-center w-full h-full text-5xl text-white bg-black/50">
                        @canvasBlock('canvas::utils.icon', [
                            'key' => 'imageIcon',
                            'options' => [
                                'icon' => '<i class="fas fa-award"></i>',
                            ],
                        ])
                    </div>
                </div>

                <div class="flex items-center mt-4 text-sm font-medium">
                    <div class="mr-4 text-xl text-palette-lightblue">
                        @canvasBlock('canvas::utils.icon', [
                            'key' => 'icon',
                            'options' => [
                                'icon' => '<i class="fas fa-award"></i>',
                            ],
                        ])
                    </div>

                    @canvasBlock('canvas::utils.text', [
                        'key' => 'iconTitle',
                        'options' => [
                            'html' => '<p>Succesverhaal</p>'
                        ]
                    ])
                </div>

                <div class="mt-4 text-lg font-semibold title">
                    @canvasBlock('canvas::utils.text', [
                        'key' => 'title',
                        'options' => [
                            'html' => '<p>Titel</p>'
                        ]
                    ])
                </div>

                <div class="mt-2 text-sm text-gray-700 description">
                    @canvasBlock('canvas::utils.text', [
                        'key' => 'description',
                        'options' => [
                            'html' => '<p>Lees hier het succesverhaal van onze klanten</p>'
                        ]
                    ])
                </div>

                <div class="mt-4">
                    @canvasBlock('canvas::utils.button', [
                        'key' => 'button',
                        'options' => [
                            'class' => 'btn-primary',
                        ]
                    ])
                </div>
            </div>

            @endCanvasLoop

        </div>

    </div>

</div>