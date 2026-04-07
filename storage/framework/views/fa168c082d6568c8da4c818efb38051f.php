<?php ($text = $canvasBlock->options->text 
    ?? \Galaxy\Canvas\Services\CanvasBlockService::createFakeUtilsLine($options)
    ?? 'Voorbeeld tekst'
); ?>

<<?=$options['tag'] ?? 'div'?>
    class="<?php echo e($cssNs); ?> <?php echo e($canvasBlock->options->class ?? ''); ?> <?php echo e($options['class'] ?? ''); ?> <?php echo e(($edit ?? false) && $text == '' ? 'min-w-[10px] min-h-[10px]' : ''); ?>"
    <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockAttrsDirective($__env, $__data))->execute(['label' => 'Lijn tekst'])?>
    data-show-openai="<?php echo e((bool)config('services.openai.api_key')); ?>"
>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!@$edit): ?>
    <?php echo \Galaxy\Canvas\Services\CanvasBlockService::renderText($text, (array) @$options['replacements']); ?>

<?php else: ?>
    <?php echo e($text); ?>

<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</<?=$options['tag'] ?? 'div'?>>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Canvas/resources/components//canvas/blocks/utils/line/block.blade.php ENDPATH**/ ?>