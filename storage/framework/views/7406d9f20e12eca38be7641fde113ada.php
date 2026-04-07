<div <?=(new Galaxy\Core\BladeDirectives\HtmlAttrsDirective($__env, $__data))->execute($htmlAttrs)?> <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockAttrsDirective($__env, $__data))->execute()?>>

    <div class="container"
        <?php if(!@$edit && config('canvas.animations.enabled')): ?> data-sal="<?php echo e(config('canvas.animations.type')); ?>"
         data-sal-duration="<?php echo e(config('canvas.animations.duration')); ?>"
         data-sal-easing="<?php echo e(config('canvas.animations.easing')); ?>" <?php endif; ?>>

        
        <div
            class="<?php echo e(\Galaxy\Canvas\Services\CanvasBlockService::getGalaxyCommonCanvasPropertyFromConfig('gap', '2column') ?: 'gap-6 md:gap-12'); ?> grid grid-cols-1 sm:grid-cols-2">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = range(1, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item">

                    <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockDirective($__env, $__data))->execute('canvas::utils.text', [
                        'key' => 'text' . $i,
                        'options' => [
                            'html' => '<p>' . config('canvas.texts.placeholder') . '</p>',
                            'ai_instruction' => true,
                        ],
                    ] + ["parentCanvasBlock" => $canvasBlock, "edit" => $edit])?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>

    </div>

</div>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Canvas/resources/components//canvas/blocks/common/2column/block.blade.php ENDPATH**/ ?>