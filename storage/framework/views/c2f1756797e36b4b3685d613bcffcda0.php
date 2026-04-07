<?php
$media = \Galaxy\Canvas\Services\MediaService::getSingleMedia($canvasBlock);

$attrs = array_merge((array) @$options['attrs'], (array) @$options['attributes']);
$attrs['class'] = implode(' ', array_filter([$cssNs, @$options['class']]));
$attrs['alt'] = $canvasBlock->options->altText ?? $attrs['alt'] ?? (
    config('galaxy.common.wcag', false) ? '' : ($media->name ?? 'placeholder')
);
$attrs['draggable'] = 'false';

if ($media && ($options['show-lightgallery'] ?? true)) {
    $attrs['data-src'] = $media->getFullUrl();
    $attrs['data-has-media'] = 'true';
}
?>

<div class="<?php echo e(@$options['wrapper'] !== null ? $options['wrapper'] : 'img-bg-wrapper'); ?>">

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($media): ?>
        <?php echo e($media->img()->attributes($attrs)->lazy()); ?>

    <?php else: ?>
        <img src="<?= $src = $options['placeholder'] ?? '/vendor/galaxy/canvas/img/blocks/utils/image/placeholder.svg' ?>"
             
            data-src="<?php echo e($src); ?>"
            
            <?=(new Galaxy\Core\BladeDirectives\HtmlAttrsDirective($__env, $__data))->execute($attrs)?>
        >
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Canvas/resources/components//canvas/blocks/utils/image/image.blade.php ENDPATH**/ ?>