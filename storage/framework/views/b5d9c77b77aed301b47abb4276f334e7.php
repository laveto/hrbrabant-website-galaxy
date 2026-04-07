<?php
    $newHtmlAttrsArray = $htmlAttrsArray;
    unset($newHtmlAttrsArray['style']['color']);
    $newHtmlAttrsArray['class']['custom'] = 'relative z-10';

    $newHtmlAttrs = collect($newHtmlAttrsArray)->map(fn($attributes) => is_array(value: $attributes) ? implode(' ', $attributes) : $attributes)->toArray()
?>
<div <?=(new Galaxy\Core\BladeDirectives\HtmlAttrsDirective($__env, $__data))->execute($newHtmlAttrs)?> <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockAttrsDirective($__env, $__data))->execute()?>>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canvasBlock->options->color ?? false): ?>
        <div class="absolute top-0 left-0 right-0 bottom-1/2 -z-10" style="background: <?php echo e($canvasBlock->options->color); ?>"></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canvasBlock->options->color2 ?? false): ?>
        <div class="absolute bottom-0 left-0 right-0 top-1/2 -z-10" style="background: <?php echo e($canvasBlock->options->color2); ?>"></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="container"
        <?php if(!@$edit && config('canvas.animations.enabled')): ?>
            data-sal="<?php echo e(config('canvas.animations.type')); ?>"
            data-sal-duration="<?php echo e(config('canvas.animations.duration')); ?>"
            data-sal-easing="<?php echo e(config('canvas.animations.easing')); ?>"
        <?php endif; ?>
    >

        <div class="mb-6">
            <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockDirective($__env, $__data))->execute('canvas::utils.text', [
                'options' => [
                    'html' => '<h2><span style="color:#D65A54">Persoonlijk</span> in personeel</h2>',
                ],
            ] + ["parentCanvasBlock" => $canvasBlock, "edit" => $edit])?>
        </div>

        <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockDirective($__env, $__data))->execute('canvas::utils.video', [
            'videoClass' => 'rounded-[2rem]',
            'autoplay' => false,
            'muted' => false,
            'controls' => true,
        ] + ["parentCanvasBlock" => $canvasBlock, "edit" => $edit])?>

    </div>

</div>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/resources/components/canvas/blocks/custom/video/block.blade.php ENDPATH**/ ?>