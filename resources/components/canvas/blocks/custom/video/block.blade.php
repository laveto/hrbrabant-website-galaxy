<?php
    $newHtmlAttrsArray = $htmlAttrsArray;
    unset($newHtmlAttrsArray['style']['color']);
    $newHtmlAttrsArray['class']['custom'] = 'relative z-10';

    $newHtmlAttrs = collect($newHtmlAttrsArray)->map(fn($attributes) => is_array(value: $attributes) ? implode(' ', $attributes) : $attributes)->toArray()
?>
<div @htmlAttrs($newHtmlAttrs) @canvasBlockAttrs()>

    @if($canvasBlock->options->color ?? false)
        <div class="absolute top-0 left-0 right-0 bottom-1/2 -z-10" style="background: {{ $canvasBlock->options->color }}"></div>
    @endif

    @if($canvasBlock->options->color2 ?? false)
        <div class="absolute bottom-0 left-0 right-0 top-1/2 -z-10" style="background: {{ $canvasBlock->options->color2 }}"></div>
    @endif

    <div class="container"
        @if (!@$edit && config('canvas.animations.enabled'))
            data-sal="{{ config('canvas.animations.type') }}"
            data-sal-duration="{{ config('canvas.animations.duration') }}"
            data-sal-easing="{{ config('canvas.animations.easing') }}"
        @endif
    >

        <div class="mb-6">
            @canvasBlock('canvas::utils.text', [
                'options' => [
                    'html' => '<h2><span style="color:#D65A54">Persoonlijk</span> in personeel</h2>',
                ],
            ])
        </div>

        @canvasBlock('canvas::utils.video', [
            'videoClass' => 'rounded-[2rem]',
            'autoplay' => false,
            'muted' => false,
            'controls' => true,
        ])

    </div>

</div>
