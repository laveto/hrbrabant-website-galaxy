<div
    class="<?php echo e($cssNs); ?> <?php echo e(@$options['topClass']); ?> <?php echo e(@$canvasBlock->options->zoomable ? 'cursor-pointer' : ''); ?>"
    data-zoomable="<?php echo e($options['zoomable'] ?? $canvasBlock->options->zoomable ?? 0); ?>"
    data-outputInstruction="<?php echo e($options['outputInstruction'] ?? ''); ?>"
    <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockAttrsDirective($__env, $__data))->execute([
        'label' => 'Afbeelding',
        'linkable' => @$options['linkable'],
        'outputOptions' => @$options['outputOptions'],
        'outputInstruction' => @$options['outputInstruction'] ?? '',
    ])?>
>

    <?php echo $__env->make('canvas-component::canvas.blocks.utils.image.image', [
        'options' => [
            'class' => @$options['class'] . (@$canvasBlock->options->imageDisplay != 'scale' ? '' : ' object-contain'),
        ] + (array) @$options,
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Canvas/resources/components//canvas/blocks/utils/image/block.blade.php ENDPATH**/ ?>