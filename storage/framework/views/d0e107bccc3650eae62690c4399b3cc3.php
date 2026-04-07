<?=(new Galaxy\Core\BladeDirectives\ResourceDirective($__env, $__data))->execute([
    '/vendor/swiper/swiper-bundle.min.css',
    '/vendor/swiper/swiper-bundle.min.js',
    '/vendor/owl.carousel/dist/owl.carousel.min.js',
    '/vendor/owl.carousel/dist/assets/owl.carousel.min.css',
])?>

<div <?=(new Galaxy\Core\BladeDirectives\HtmlAttrsDirective($__env, $__data))->execute($htmlAttrs)?> <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockAttrsDirective($__env, $__data))->execute()?>>

    <div class="container overflow-x-hidden"
        <?php if(!@$edit && config('canvas.animations.enabled')): ?>
            data-sal="<?php echo e(config('canvas.animations.type')); ?>"
            data-sal-duration="<?php echo e(config('canvas.animations.duration')); ?>"
            data-sal-easing="<?php echo e(config('canvas.animations.easing')); ?>"
        <?php endif; ?>
    >
        <div class="flex items-center justify-center mb-6">
            <h4 class="mb-8 lg:mb-12">
                <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockDirective($__env, $__data))->execute('canvas::utils.line', [
                    'options' => [
                        'text' => 'Onze opdrachtgevers',
                    ],
                ] + ["parentCanvasBlock" => $canvasBlock, "edit" => $edit])?>
            </h4>
        </div>


        <div class="relative slider">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!($edit ?? false)): ?>
                <div class="absolute inset-0 z-10 w-full pointer-events-none bg-gradient-to-r from-white via-transparent to-white"></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="owl-carousel owl-theme"
                 data-autoplay="<?php echo e(@$edit ? 0 : 1); ?>"
                 data-edit="<?php echo e(@$edit ? 1 : 0); ?>"
                 <?=(new Galaxy\Canvas\BladeDirectives\CanvasEditableAttrsDirective($__env, $__data))->execute([
                    'editor' => 'loop-owlCarousel-LoopEditor',
                    'label' => 'Items',
                    'itemSelector' => '.item',
                ])?>
            >
                <?php $__directiveInstances[] = $__directiveInstance = new Galaxy\Canvas\BladeDirectives\CanvasLoopDirective($__env, $__data, ['items' =>  8]); ?><?=$__directiveInstance->start(['items' =>  8]); ?><?php $__currentLoopData = $__directiveInstance->getLoopData(); $__env->addLoop($__currentLoopData); $__directiveInstance->registerLoop($__env->getLastLoop()->depth); foreach($__currentLoopData as $loopItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?=last($__directiveInstances)->startItem($loopItem, $loop); ?>

                    <div class="item"
                        <?=(new Galaxy\Canvas\BladeDirectives\CanvasEditableAttrsDirective($__env, $__data))->execute([
                            'editor' => 'loop-owlCarousel-LoopItemEditor',
                            'itemPanel' => 'LoopItemPanel',
                            'label' => 'Item'
                        ])?>
                    >

                        
                        <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockDirective($__env, $__data))->execute('canvas::utils.image', [
                            'class' => 'img-fluid aspect-[4/2] md:aspect-[7/2] object-contain',
                            'placeholder' => '/vendor/galaxy/canvas/img/blocks/common/placeholder.jpg',
                            'wrapper' => '',
                        ] + ["parentCanvasBlock" => $canvasBlock, "edit" => $edit])?>

                    </div>

                <?=last($__directiveInstances)->endItem($loop); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?=array_pop($__directiveInstances)->end(); ?>
            </div>

            <!-- Add navigation buttons -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( $edit ?? false): ?>
                <button class="owl-prev" aria-label="Vorige">
                    <i class="fas fa-angle-left"></i>
                </button>
                <button class="owl-next" aria-label="Volgende">
                    <i class="fas fa-angle-right"></i>
                </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>

    </div>

</div>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/resources/components/canvas/blocks/custom/sponsorSlider/block.blade.php ENDPATH**/ ?>