<div <?=(new Galaxy\Core\BladeDirectives\HtmlAttrsDirective($__env, $__data))->execute($htmlAttrs)?> <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockAttrsDirective($__env, $__data))->execute()?>>

    <div class="container"
        <?php if(!@$edit && config('canvas.animations.enabled')): ?>
            data-sal="<?php echo e(config('canvas.animations.type')); ?>"
            data-sal-duration="<?php echo e(config('canvas.animations.duration')); ?>"
            data-sal-easing="<?php echo e(config('canvas.animations.easing')); ?>"
        <?php endif; ?>
    >

        
        <div class="gap-6 grid lg:gap-12 lg:grid-cols-2 shadow-[0_16px_56px_#00000029] rounded-2xl overflow-hidden">

            <div class="flex items-center px-8 py-8 column lg:px-16">

                <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockDirective($__env, $__data))->execute('canvas::utils.text', [
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
                ] + ["parentCanvasBlock" => $canvasBlock, "edit" => $edit])?>

            </div>

            <div class="column">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( $canvasBlock->options->showDefaultImage ?? true ): ?>
                    <?php ($block = \Galaxy\WebsiteBlocks\Models\Block::where('key', 'team_photo')->first() ?? null); ?>
                    <?php ($image = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($block->extra?->foto?->value ?? null)); ?>

                    <img
                        src="<?php echo e($image?->getUrl() ?? '/vendor/galaxy/canvas/img/blocks/common/placeholder.jpg'); ?>"
                        alt="<?php echo e($image?->title ?? 'Placeholder Image'); ?>"
                        class="img-fluid h-full w-full object-cover aspect-[608/504]"
                        loading="lazy"
                    />
                <?php else: ?>
                    <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockDirective($__env, $__data))->execute('canvas::utils.image', [
                        'class' => 'img-fluid h-full w-full object-cover aspect-[608/504]',
                        'placeholder' => '/vendor/galaxy/canvas/img/blocks/common/placeholder.jpg',
                        'wrapper' => 'h-full w-full',
                        'outputOptions' => [
                            'width' => 1216,
                            'height' => 1008,
                        ],
                    ] + ["parentCanvasBlock" => $canvasBlock, "edit" => $edit])?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>

        </div>

    </div>

</div>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/resources/components/canvas/blocks/custom/leftTextImageRight/block.blade.php ENDPATH**/ ?>