<div @htmlAttrs($htmlAttrs) @canvasBlockAttrs()>

    <div class="container"
        @if (!@$edit && config('canvas.animations.enabled'))
            data-sal="{{ config('canvas.animations.type') }}"
            data-sal-duration="{{ config('canvas.animations.duration') }}"
            data-sal-easing="{{ config('canvas.animations.easing') }}"
        @endif
    >

        {{-- To change gap property: galaxy.common.canvas.left_text_image_right.gap --}}
        <div class="gap-6 grid lg:gap-12 lg:grid-cols-2 shadow-[0_16px_56px_#00000029] rounded-2xl overflow-hidden">

            <div class="flex items-center px-8 py-8 column lg:px-16">

                @canvasBlock('canvas::utils.text', [
                    'options' => [
                        'html' => '
                            <h2>Heb je nog vragen of wil je meer informatie?</h2>

                            <p>Aarzel niet om contact met ons op te nemen voor meer informatie</p>

                            <table border="0" cellpadding="10" cellspacing="1" style="width:100%">
                                <tbody>
                                <tr>
                                    <td><a class="btn-primary" href="mailto:info@hrzeeland.nl">Stuur een mail</a></td>
                                    <td><a class="btn-outline" href="#">Bel me terug</a></td>
                                </tr>
                                </tbody>
                            </table>
                        ',
                    ],
                ])

            </div>

            <div class="column">

                @if( $canvasBlock->options->showDefaultImage ?? true )
                    @php($block = \Galaxy\WebsiteBlocks\Models\Block::where('key', 'team_photo')->first() ?? null)
                    @php($image = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($block->extra?->foto?->value ?? null))

                    <img
                        src="{{ $image?->getUrl() ?? '/vendor/galaxy/canvas/img/blocks/common/placeholder.jpg' }}"
                        alt="{{ $image?->title ?? 'Placeholder Image' }}"
                        class="img-fluid h-full w-full object-cover aspect-[608/504]"
                        loading="lazy"
                    />
                @else
                    @canvasBlock('canvas::utils.image', [
                        'class' => 'img-fluid h-full w-full object-cover aspect-[608/504]',
                        'placeholder' => '/vendor/galaxy/canvas/img/blocks/common/placeholder.jpg',
                        'wrapper' => 'h-full w-full',
                        'outputOptions' => [
                            'width' => 1216,
                            'height' => 1008,
                        ],
                    ])
                @endif

            </div>

        </div>

    </div>

</div>
