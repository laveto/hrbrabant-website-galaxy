<?php $__env->startSection('main.content'); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canvas = \Galaxy\Canvas\Models\Canvas::where('tag', 'website-404')->first()): ?>
        <?php ($canvasVersion = \Galaxy\Canvas\Services\VersionService::getActiveFromCanvasWithFallbackCached($canvas, request()->language())); ?>

        <?php if (isset($component)) { $__componentOriginal8b40699774e5ef38cbcb6a89cb954469 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8b40699774e5ef38cbcb6a89cb954469 = $attributes; } ?>
<?php $component = Galaxy\Canvas\View\Components\Canvas::resolve(['canvasVersion' => $canvasVersion] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
    <?php else: ?>
        <div class="py-20 text-center error-404">

            <h1 class="mb-4 text-6xl">404</h1>

            <h2 class="text-2xl"><?php echo e(__('Pagina niet gevonden')); ?></h2>

            <p class="mt-4 mb-6 text-gray-500"><?php echo e(__('Deze pagina bestaat niet')); ?></p>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request()->headers->get('referer')): ?>
                <a class="inline-flex items-center px-6 py-3 mt-8 text-base font-medium text-white bg-gray-600 border border-transparent rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                    href="<?php echo e(request()->headers->get('referer')); ?>">
                    <?php echo $__env->make('admin::partials.icons.arrow-down', [
                        'class' => 'transform rotate-90 mr-2 w-6 h-6',
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <span><?php echo e(__('Ga terug')); ?></span>
                </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('website::layouts.main', ['title' => 'Error 404'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Website/resources/views/errors/404.blade.php ENDPATH**/ ?>