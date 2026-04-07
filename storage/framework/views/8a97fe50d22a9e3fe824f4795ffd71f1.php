<div class="<?php echo e($cssNs); ?> <?php echo e(@$options['class'] ?? 'w-full h-full'); ?>"
     <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockAttrsDirective($__env, $__data))->execute([
         'label' => 'Video',
     ])?>>

        <?php echo $__env->make('canvas-component::canvas.blocks.utils.video.video', [
             'options' => [
                 'class' => @$options['class'],
             ] + (array)$canvasBlock->options + (array) @$options,
         ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Canvas/resources/components//canvas/blocks/utils/video/block.blade.php ENDPATH**/ ?>