<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( ($canvasId = \Galaxy\Canvas\Services\CanvasService::renderThemeCanvas('header_canvas'))
    && !request()->is(config('admin.routes.prefix').'/*')
): ?>
    <?php if (isset($component)) { $__componentOriginal8b40699774e5ef38cbcb6a89cb954469 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8b40699774e5ef38cbcb6a89cb954469 = $attributes; } ?>
<?php $component = Galaxy\Canvas\View\Components\Canvas::resolve(['canvas' => \Galaxy\Canvas\Models\Canvas::find($canvasId),'canvasVersion' => null,'tag' => null] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('canvas::canvas'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Galaxy\Canvas\View\Components\Canvas::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['layoutAttributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(get_defined_vars())]); ?>
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
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?><?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Website/resources/views/layouts/main/canvas/header.blade.php ENDPATH**/ ?>