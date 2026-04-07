<div @htmlAttrs($htmlAttrs) @canvasBlockAttrs()>

    <div class="container"
        @if (!@$edit && config('canvas.animations.enabled')) data-sal="{{ config('canvas.animations.type') }}"
         data-sal-duration="{{ config('canvas.animations.duration') }}"
         data-sal-easing="{{ config('canvas.animations.easing') }}" @endif>

        {{-- To change gap property: common.canvas.2column.gap --}}
        <div class="{{ \Galaxy\Canvas\Services\CanvasBlockService::getGalaxyCommonCanvasPropertyFromConfig('gap', '2column') ?: 'gap-6' }} grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 lg:px-16 lg:items-center">

            @foreach (range(1, 5) as $i)
                <div class="item">

                    @canvasBlock('canvas::utils.text', [
                        'key' => 'text' . $i,
                            'options' => [
                            'html' => '<p>Tekst hier</p>',
                        ],
                    ])

                </div>
            @endforeach

        </div>

    </div>

</div>
