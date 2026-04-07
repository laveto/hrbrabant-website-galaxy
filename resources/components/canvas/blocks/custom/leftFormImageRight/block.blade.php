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

            <div class="flex flex-col justify-center px-8 py-8 lg:py-16 column lg:px-16">

                <div class="mb-8">
                    @canvasBlock('canvas::utils.text', [
                        'options' => [
                            'html' => '<h2>Formulier</h2>',
                        ],
                    ])
                </div>

                {{-- Render form? --}}
                @if(($formId = @$canvasBlock->options->form_id) 
                    && ($form = \Galaxy\WebsiteForms\Models\Form::find($formId)) && $form->isPublished()
                )

                    <div class="w-full">

                        @include('website_forms-component::canvas.blocks.modules.form.form', [
                            'form' => $form,
                            'url' => action([Galaxy\WebsiteForms\Resources\Components\Canvas\Blocks\Modules\Form\WebsiteController::class, 'store'], ['canvasBlock' => $canvasBlock->id]),
                            'forceLabels' => false,
                            'vertical' => true,
                            'extra' => array_replace_recursive([
                                'formStyle' => 'contact',
                            ], $attributes->get('extra') ?? $extra ?? []),
                        ])

                    </div>

                {{-- Render no form present? --}}
                @else
                    <div class="p-4 mb-4 rounded-md bg-yellow-50">
                        <p class="flex items-center justify-center mb-0 text-sm font-medium text-yellow-800">
                            Selecteer een formulier om hier te tonen.
                        </p>
                    </div>
                @endif

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
