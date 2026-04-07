<div class="<?php echo e($cssNs); ?> <?php echo e($canvasBlock->options->class ?? ''); ?>" 
	<?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockAttrsDirective($__env, $__data))->execute(['label' => 'Tekst'])?>
	data-show-openai="<?php echo e((bool)config('services.openai.api_key') ? 1 : 0); ?>"
	data-fake-text="<?php echo e(\Galaxy\Canvas\Services\CanvasBlockService::createFakeUtilsText($options)); ?>"
>
	<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( config('services.openai.api_key')
		&& config('services.openai.show_instructions')
		&& isset($options['options']['html']) 
		&& $options['options']['html'] == $canvasBlock->options->html 
		&& ($canvasBlock->options->ai_instruction ?? false) 
	): ?>
		<?php echo __('Start met typen van je tekst of klik op het :icon icoon voor de AI assistent.', [
			'icon' => ' <img src="/vendor/galaxy/canvas/img/editor/admin/ai_stars.png" class="inline-block w-auto h-8" />',
		]); ?>

		<br /><br />
	<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

	<?php echo \Galaxy\Canvas\Services\CanvasBlockService::renderText(
		$canvasBlock->options->html
			?? \Galaxy\Canvas\Services\CanvasBlockService::createFakeUtilsText($options)
			?? 'Voorbeeld tekst',
		(array) @$options['replacements'],
		(bool) @$options['stripLinks']
	); ?>

</div>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Canvas/resources/components//canvas/blocks/utils/text/block.blade.php ENDPATH**/ ?>