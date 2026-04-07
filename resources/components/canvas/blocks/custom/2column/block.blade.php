<?php
    $newHtmlAttrsArray = $htmlAttrsArray;
    unset($newHtmlAttrsArray['style']['color']);
    $newHtmlAttrsArray['class']['custom'] = 'relative z-10';

    $newHtmlAttrs = collect($newHtmlAttrsArray)->map(fn($attributes) => is_array($attributes) ? implode(' ', $attributes) : $attributes)->toArray()
?>
<div @htmlAttrs($newHtmlAttrs) @canvasBlockAttrs()>

    <div class="container"
        @if (!@$edit && config('canvas.animations.enabled')) data-sal="{{ config('canvas.animations.type') }}"
         data-sal-duration="{{ config('canvas.animations.duration') }}"
         data-sal-easing="{{ config('canvas.animations.easing') }}" @endif>

        {{-- To change gap property: common.canvas.2column.gap --}}
        <div class="{{ \Galaxy\Canvas\Services\CanvasBlockService::getGalaxyCommonCanvasPropertyFromConfig('gap', '2column') ?: 'gap-6' }} grid grid-cols-1 sm:grid-cols-2">

            <div class="column">

                <div @canvasEditableAttrs([
                    'editor' => 'loop-LoopEditor',
                    'label' => 'Items',
                    'itemSelector' => '.item',
                    'loopKey' => 'left',
                ])>
                    @canvasLoop(['key' => 'left', 'items' => 2])

                        <div class="flex items-center gap-4 mb-4 item lg:mb-8"
                            @canvasEditableAttrs(['editor' => 'loop-LoopItemEditor', 'label' => 'Item'])
                        >

                            @canvasBlock('canvas::utils.image', [
                                'key' => 'card-icon',
                                'class' => 'w-12 h-12 aspect-[1] object-cover',
                                'placeholder' => '/vendor/galaxy/admin/img/common/placeholder.png',
                                'outputOptions' => [
                                    'width' => 80,
                                    'height' => 80,
                                ],
                                'wrapper' => '',
                                'topClass' => 'flex-shrink-0',
                            ])

                            <div class="mb-0 text-3xl font-semibold text-white">
                                @canvasBlock('canvas::utils.line', [
                                    'key' => 'title',
                                    'options' => [
                                        'text' => 'Techniek',
                                    ],
                                ])
                            </div>

                        </div>

                    @endCanvasLoop
                </div>

            </div>

            <div class="column">

                <div @canvasEditableAttrs([
                    'editor' => 'loop-LoopEditor',
                    'label' => 'Items',
                    'itemSelector' => '.item',
                    'loopKey' => 'right',
                ])>
                    @canvasLoop(['key' => 'right', 'items' => 2])

                        <div class="flex items-center gap-4 mb-4 item lg:mb-8"
                            @canvasEditableAttrs(['editor' => 'loop-LoopItemEditor', 'label' => 'Item'])
                        >

                            @canvasBlock('canvas::utils.image', [
                                'key' => 'card-icon',
                                'class' => 'w-12 h-12 aspect-[1] object-cover',
                                'placeholder' => '/vendor/galaxy/admin/img/common/placeholder.png',
                                'outputOptions' => [
                                    'width' => 80,
                                    'height' => 80,
                                ],
                                'wrapper' => '',
                                'topClass' => 'flex-shrink-0',
                            ])

                            <div class="mb-0 text-3xl font-semibold text-white">
                                @canvasBlock('canvas::utils.line', [
                                    'key' => 'title',
                                    'options' => [
                                        'text' => 'Techniek',
                                    ],
                                ])
                            </div>

                        </div>

                    @endCanvasLoop
                </div>

            </div>

        </div>

    </div>

    @canvasBlock('canvas::utils.image', [
        'class' => 'img-fluid w-full h-full object-cover object-bottom',
        'placeholder' => '/vendor/galaxy/canvas/img/blocks/common/placeholder.jpg',
        'topClass' => 'absolute inset-0 -z-20',
        'wrapper' => 'h-full w-full',
        'outputOptions' => [
            'width' => 1920,
            'height' => 824,
        ],
    ])

</div>
