<div @htmlAttrs($htmlAttrs) @canvasBlockAttrs()>

    <div class="container"
        @if (!@$edit && config('canvas.animations.enabled'))
            data-sal="{{ config('canvas.animations.type') }}"
            data-sal-duration="{{ config('canvas.animations.duration') }}"
            data-sal-easing="{{ config('canvas.animations.easing') }}"
        @endif>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2"
            @canvasEditableAttrs([
                'editor' => 'loop-LoopEditor',
                'label' => 'Items',
                'itemSelector' => '.column',
            ])>

            @canvasLoop(['items' => 2])
                <div class="relative column {{ @$loopItem->url || @$loopItem->websitePageId ? 'lg:hover:scale-105 transition' : ''}}" 
                    @canvasEditableAttrs([
                        'editor' => 'loop-LoopItemEditor',
                        'itemPanel' => 'LoopItemPanel',
                        'label' => 'Item'
                    ])
                >

                    @if(@$loopItem->url || @$loopItem->websitePageId)
                        <a
                            href="{{ @$loopItem->linkTarget == 'websitePage' || !@$loopItem->linkTarget
                                            ? (url()->websitePage(@$loopItem->websitePageId) ?? '#')
                                            : ($loopItem->url ?? '#')
                                        }}"
                            target="{{ $loopItem->target ?? '_self' }}"
                        >
                    @endif

                        <div class="absolute inset-0 z-10 bg-gradient-to-b from-palette-blue to-transparent rounded-2xl bg-primary"
                            style="--tw-gradient-from: {{ $loopItem->color ?? '#D65A54 var(--tw-gradient-from-position)' }}; --tw-gradient-to: transparent;
                                --tw-gradient-stops: {{ $gradientFrom = $loopItem->color ?? 'var(--tw-gradient-from)' }}, {{ $gradientFrom }}, var(--tw-gradient-to), var(--tw-gradient-to);">

                        </div>

                        @canvasBlock('canvas::utils.image', [
                            'wrapper' => '',
                            'topClass' => 'absolute inset-0',
                            'class' => 'absolute h-full inset-0 w-full object-cover rounded-2xl',
                            'placeholder' => '/vendor/galaxy/admin/img/common/placeholder.png',
                            'outputOptions' => [
                                'width' => 1200,
                                'height' => 600,
                            ],
                        ])

                        <div class="aspect-1 lg:aspect-[2/1] relative z-20 mb-0 text-white">
                            <div class="p-4 md:p-8">
                                <div class="mb-2 text-3xl font-bold">
                                    @canvasBlock('canvas::utils.line', [
                                        'key' => 'title',
                                        'options' => [
                                            'text' => 'Techniek',
                                        ],
                                    ])
                                </div>

                                @canvasBlock('canvas::utils.text', [
                                    'key' => 'subtitle',
                                    'options' => [
                                        'html' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec purus nec nunc.</p>',
                                    ],
                                ])
                            </div>
                        </div>

                    @if(@$loopItem->url || @$loopItem->websitePageId)
                        </a>
                    @endif

                </div>
            @endCanvasLoop

        </div>

    </div>

</div>
