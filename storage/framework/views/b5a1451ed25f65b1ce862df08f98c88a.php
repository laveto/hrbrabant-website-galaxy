<?php $__env->startSection('main.content'); ?>
	<div class="<?php echo e($cssNs); ?>">

        <?php if (isset($component)) { $__componentOriginal8b40699774e5ef38cbcb6a89cb954469 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8b40699774e5ef38cbcb6a89cb954469 = $attributes; } ?>
<?php $component = Galaxy\Canvas\View\Components\Canvas::resolve(['canvasVersion' => $canvasVersion,'injectedViews' => $injectedViews ?? []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('canvas::canvas'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Galaxy\Canvas\View\Components\Canvas::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8b40699774e5ef38cbcb6a89cb954469)): ?>
<?php $attributes = $__attributesOriginal8b40699774e5ef38cbcb6a89cb954469; ?>
<?php unset($__attributesOriginal8b40699774e5ef38cbcb6a89cb954469); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8b40699774e5ef38cbcb6a89cb954469)): ?>
<?php $component = $__componentOriginal8b40699774e5ef38cbcb6a89cb954469; ?>
<?php unset($__componentOriginal8b40699774e5ef38cbcb6a89cb954469); ?>
<?php endif; ?>

	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website::layouts.main', [
	'title' => $websitePage->title_page ?: $websitePage->title_menu,
    //'breadcrumbs' => [
    //    url(strtolower($websitePage->slug)) => ucfirst($websitePage->title_page ?: $websitePage->title_menu),
    //],
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Website/resources/views/page.blade.php ENDPATH**/ ?>