<?=(new Galaxy\Core\BladeDirectives\ResourceDirective($__env, $__data))->execute([
	'/vendor/iframe-resizer/js/iframeResizer.contentWindow.js',
])?>

<div class="<?php echo e($cssNs); ?> <?php echo e($class ?? ''); ?>">

	
	<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($injectedViews[0])): ?>
		<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $injectedViews[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $injectedView): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php echo $__env->make($injectedView['view'], $injectedView['data'] ?? [], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
	<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

	<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $getCanvasBlocksTree() ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $canvasBlock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

		<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(@$edit || $canvasBlock->visible): ?>
			
			<?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockIncludeDirective($__env, $__data))->execute([
				'canvasVersion' => $canvasVersion,
				'canvasBlock' => $canvasBlock,
				'edit' => $edit ?? false,
				'attributes' => $attributes ?? [],
			])?>
		<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

		
		<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($injectedViews[$index + 1])): ?>
			<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $injectedViews[$index + 1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $injectedView): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php echo $__env->make($injectedView['view'], $injectedView['data'] ?? [], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
		<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div><?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Canvas/resources/views/canvas.blade.php ENDPATH**/ ?>