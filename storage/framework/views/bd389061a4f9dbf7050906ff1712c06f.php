<div <?=(new Galaxy\Core\BladeDirectives\HtmlAttrsDirective($__env, $__data))->execute($htmlAttrs)?> <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockAttrsDirective($__env, $__data))->execute()?>>

    <div class="container"
        <?php if(!@$edit && config('canvas.animations.enabled')): ?>
            data-sal="<?php echo e(config('canvas.animations.type')); ?>"
            data-sal-duration="<?php echo e(config('canvas.animations.duration')); ?>"
            data-sal-easing="<?php echo e(config('canvas.animations.easing')); ?>"
        <?php endif; ?>
    >

        <div class="mb-6 text-center">
            <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockDirective($__env, $__data))->execute('canvas::utils.text', [
                'options' => [
                    'html' => '<h3>Wat onze klanten zeggen</h3>',
                ],
            ] + ["parentCanvasBlock" => $canvasBlock, "edit" => $edit])?>
        </div>

        <div class="overflow-hidden">
            <div class="swiper-container relative">
                <div class="swiper-wrapper"
                     <?=(new Galaxy\Canvas\BladeDirectives\CanvasEditableAttrsDirective($__env, $__data))->execute([
                        'editor' => 'loop-swiper-LoopEditor',
                        'label' => 'Items',
                        'itemSelector' => '.item',
                    ])?>
                >
                    <?php $__directiveInstances[] = $__directiveInstance = new Galaxy\Canvas\BladeDirectives\CanvasLoopDirective($__env, $__data, ['items' => 2]); ?><?=$__directiveInstance->start(['items' => 2]); ?><?php $__currentLoopData = $__directiveInstance->getLoopData(); $__env->addLoop($__currentLoopData); $__directiveInstance->registerLoop($__env->getLastLoop()->depth); foreach($__currentLoopData as $loopItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?=last($__directiveInstances)->startItem($loopItem, $loop); ?>

                        <div class="item swiper-slide rounded-2xl bg-palette-grayishlighterbue py-4 px-8 lg:px-24 lg:py-14"
                             <?=(new Galaxy\Canvas\BladeDirectives\CanvasEditableAttrsDirective($__env, $__data))->execute([
                                'editor' => 'loop-swiper-LoopItemEditor',
                                'itemPanel' => 'LoopItemPanel',
                                'label' => 'Item'
                            ])?>
                        >

                            <div class="flex flex-col items-center text-white px-8">

                                <div class="relative mb-2">
                                    <div class="absolute text-white opacity-25">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="overflow-hidden whitespace-nowrap" style="width: <?php echo e($loopItem->rating ?? '0'); ?>%;">
                                        <div class="text-white">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>

                                </div>

                                <div class="text-center mb-4">
                                    <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockDirective($__env, $__data))->execute('canvas::utils.text', [
                                        'options' => [
                                            'html' => '<p>' . config('canvas.texts.placeholder') . '</p>',
                                        ],
                                    ] + ["parentCanvasBlock" => $canvasBlock, "edit" => $edit])?>
                                </div>

                                <div class="font-semibold">
                                    <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockDirective($__env, $__data))->execute('canvas::utils.line', [
                                        'options' => [
                                            'text' => 'Auteur',
                                        ],
                                    ] + ["parentCanvasBlock" => $canvasBlock, "edit" => $edit])?>
                                </div>
                            </div>

                        </div>
                    <?=last($__directiveInstances)->endItem($loop); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?=array_pop($__directiveInstances)->end(); ?>
                </div>

                <!-- Add navigation buttons -->
                <div class="-translate-y-1/2 absolute bg-white button-prev flex h-8 items-center justify-center ml-4 left-0 rounded-full swiper-button-disabled text-black top-1/2 w-8 z-10">
                    <i class="fas fa-angle-left text-palette-grayishblue"></i>
                </div>

                <div class="-translate-y-1/2 absolute bg-white button-next flex h-8 items-center justify-center mr-4 right-0 rounded-full swiper-button-disabled text-black top-1/2 w-8 z-10">
                    <i class="fas fa-angle-right text-palette-grayishblue"></i>
                </div>
            </div>
    </div>

    </div>

</div>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/resources/components/canvas/blocks/custom/reviews/block.blade.php ENDPATH**/ ?>