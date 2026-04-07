<?=(new Galaxy\Core\BladeDirectives\ResourceDirective($__env, $__data))->execute([
    '/vendor/swiper/swiper-bundle.min.css',
    '/vendor/swiper/swiper-bundle.min.js',
])?>

<div <?=(new Galaxy\Core\BladeDirectives\HtmlAttrsDirective($__env, $__data))->execute($htmlAttrs)?> <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockAttrsDirective($__env, $__data))->execute()?>>

    <div class="container"
        <?php if(!@$edit && config('canvas.animations.enabled')): ?>
            data-sal="<?php echo e(config('canvas.animations.type')); ?>"
            data-sal-duration="<?php echo e(config('canvas.animations.duration')); ?>"
            data-sal-easing="<?php echo e(config('canvas.animations.easing')); ?>"
        <?php endif; ?>
    >

        
        <div class="gap-x-8 lg:gap-x-[6rem] gap-y-16 lg:gap-y-8 grid items-center lg:grid-cols-2">

            <div class="column">

                <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockDirective($__env, $__data))->execute('canvas::utils.text', [
                    'options' => [
                        'html' => '<p>' . config('canvas.texts.placeholder') . '</p>',
                    ],
                ] + ["parentCanvasBlock" => $canvasBlock, "edit" => $edit])?>

            </div>

            <div class="pt-12 column">

                <div class="relative select-none slider"
                     data-autoplay="<?php echo e(@$edit ? 0 : 1); ?>"
                     <?=(new Galaxy\Canvas\BladeDirectives\CanvasEditableAttrsDirective($__env, $__data))->execute([
                        'editor' => 'loop-swiper-LoopEditor',
                        'label' => 'Items',
                        'itemSelector' => '.item',
                    ])?>
                >

                    <div class="slide-wrapper">
                        <?php $__directiveInstances[] = $__directiveInstance = new Galaxy\Canvas\BladeDirectives\CanvasLoopDirective($__env, $__data, ['items' =>  3]); ?><?=$__directiveInstance->start(['items' =>  3]); ?><?php $__currentLoopData = $__directiveInstance->getLoopData(); $__env->addLoop($__currentLoopData); $__directiveInstance->registerLoop($__env->getLastLoop()->depth); foreach($__currentLoopData as $loopItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?=last($__directiveInstances)->startItem($loopItem, $loop); ?>

                            <div class="relative z-10 item"
                                <?=(new Galaxy\Canvas\BladeDirectives\CanvasEditableAttrsDirective($__env, $__data))->execute([
                                    'editor' => 'loop-swiper-LoopItemEditor',
                                    'label' => 'Item'
                                ])?>
                            >

                                <div class="overlay absolute inset-0 rounded-[2rem] pointer-events-none opacity-0 transition duration-300 z-10"></div>

                                
                                <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockDirective($__env, $__data))->execute('canvas::utils.image', [
                                    'class' => 'img-fluid aspect-[1056/850] object-cover rounded-[2rem]',
                                    'placeholder' => '/vendor/galaxy/canvas/img/blocks/common/placeholder.jpg',
                                    'wrapper' => '',
                                    'loading' => 'lazy',
                                    'outputOptions' => [
                                        'width' => 1056,
                                        'height' => 850,
                                    ],
                                ] + ["parentCanvasBlock" => $canvasBlock, "edit" => $edit])?>

                                <div class="absolute bg-gradient-to-b from-transparent inset-0 to-palette-blue top-1/2 via-70% via-palette-blue pointer-events-none"></div>

                                <div class="absolute left-0 right-0 z-30 flex items-center justify-center bottom-1/4">
                                    <div class="flex items-center justify-center gap-2 pt-2 pb-2 pl-2 pr-4 font-semibold bg-white rounded-full text-palette-lightblue hover:bg-opacity-75">
                                        <div class="w-8 aspect-[1] rounded-full bg-palette-lightblue flex justify-center items-center text-white text-xl">
                                            <i class="fas fa-check"></i>
                                        </div>

                                        <div class='sliderBadge'>
                                            <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockDirective($__env, $__data))->execute('canvas::utils.text', [
                                                'key' => 'slideBadge',
                                                'options' => [
                                                    'html' => 'Accountmanager',
                                                ],
                                            ] + ["parentCanvasBlock" => $canvasBlock, "edit" => $edit])?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        <?=last($__directiveInstances)->endItem($loop); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?=array_pop($__directiveInstances)->end(); ?>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( $edit ?? false ): ?>
                        <span class="absolute z-20 flex items-center justify-center w-12 h-12 ml-4 text-white rounded-full cursor-pointer prev top-1/2 lef-0 bg-palette-blue">
                            <i class="fas fa-angle-left"></i>
                        </span>

                        <span class="absolute right-0 z-20 flex items-center justify-center w-12 h-12 mr-4 text-white rounded-full cursor-pointer next top-1/2 bg-palette-blue">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

            </div>

        </div>

    </div>

</div>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/resources/components/canvas/blocks/custom/leftTextSliderRight/block.blade.php ENDPATH**/ ?>