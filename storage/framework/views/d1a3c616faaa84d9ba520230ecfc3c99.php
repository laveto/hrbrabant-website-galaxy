<?=(new Galaxy\Core\BladeDirectives\ResourceDirective($__env, $__data))->execute([
    '/vendor/swiper/swiper-bundle.min.css',
    '/vendor/swiper/swiper-bundle.min.js',
])?>

<div <?=(new Galaxy\Core\BladeDirectives\HtmlAttrsDirective($__env, $__data))->execute($htmlAttrs)?> <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockAttrsDirective($__env, $__data))->execute()?>>

    <div class="py-1 overflow-x-hidden">
        <div class="container flex flex-col flex-wrap items-start gap-8 mb-6 md:flex-row"
            <?php if(!@$edit && config('canvas.animations.enabled')): ?>
                data-sal="<?php echo e(config('canvas.animations.type')); ?>"
                data-sal-duration="<?php echo e(config('canvas.animations.duration')); ?>"
                data-sal-easing="<?php echo e(config('canvas.animations.easing')); ?>"
            <?php endif; ?>
        >
            <div class="pr-4 mb-0 text-white">
                <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockDirective($__env, $__data))->execute('canvas::utils.text', [
                    'options' => [
                        'html' => '<span class="h2">Vacatures</span>',
                    ],
                ] + ["parentCanvasBlock" => $canvasBlock, "edit" => $edit])?>
            </div>

            <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockDirective($__env, $__data))->execute('canvas::utils.button', [
                'class' => 'bg-[#B54B46] px-5 py-2 text-white hover:bg-opacity-75 rounded-full inline-block order-2 md:order-none md:ml-auto',
            ] + ["parentCanvasBlock" => $canvasBlock, "edit" => $edit])?>

            <div class="relative w-full swiper-container">

                <?php
                    $amount = count((array)@$canvasBlock->options->loops->loop->items ?: []) ?: 5;
                    $items = \App\Modules\Vacancy\Models\Vacancy::with('vacancyValues')->orderBy('publicationStartDate', 'desc')
                        ->when(isset($canvasBlock->options->vacancies) && str_starts_with($canvasBlock->options->vacancies, 'https://hrzeeland.nl/vacatures?filter'), function($query) use ($canvasBlock){

                            $data = Cache::remember('blocks.custom.vacancySlider.'.$canvasBlock->id.'filter-url', 60, function() use ($canvasBlock, $query) {
                                $response = Http::get($canvasBlock->options->vacancies.'&json=true');

                                return $response->successful() ? $response->json() : [];
                            });

                            $query->whereIn('referenceNr', $data ?: []);
                        })
                        ->when(!empty($canvasBlock->options->vacancies) && !str_starts_with($canvasBlock->options->vacancies, 'https://hrzeeland.nl/vacatures?filter'), function ($query) use ($canvasBlock) {
                            $query->whereIn('referenceNr', explode(',', $canvasBlock->options->vacancies));
                        })
                        ->limit($amount)
                        ->get();
                ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( $items->isEmpty() ): ?>

                <div class="swiper-wrapper">
                    <div class="flex gap-2 flex-col items-center justify-center w-full p-8 min-h-[20rem] text-center text-white bg-palette-grayishblue rounded-2xl">
                        <?php echo e(__('Momenteel zijn er geen vacatures beschikbaar')); ?>


                        <a href="<?php echo e(action([\App\Modules\Vacancy\Resources\Components\Website\Modules\Vacancy\Controller::class, 'index'])); ?>"
                            class="px-8 py-3 mt-4 text-white rounded btn bg-palette-lightblue hover:bg-palette-blue"
                        >
                            <?php echo e(__('Bekijk alle vacatures')); ?>

                        </a>
                    </div>
                </div>

                <?php else: ?>

                    <div class="swiper-wrapper"
                        <?=(new Galaxy\Canvas\BladeDirectives\CanvasEditableAttrsDirective($__env, $__data))->execute([
                            'editor' => 'loop-swiper-LoopEditor',
                            'label' => 'Items',
                            'itemSelector' => '.item',
                        ])?>
                    >
                        <?php ($index = 0); ?>
                        <?php $__directiveInstances[] = $__directiveInstance = new Galaxy\Canvas\BladeDirectives\CanvasLoopDirective($__env, $__data, ['items' =>  5]); ?><?=$__directiveInstance->start(['items' =>  5]); ?><?php $__currentLoopData = $__directiveInstance->getLoopData(); $__env->addLoop($__currentLoopData); $__directiveInstance->registerLoop($__env->getLastLoop()->depth); foreach($__currentLoopData as $loopItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?=last($__directiveInstances)->startItem($loopItem, $loop); ?>

                            <?php if(!$item = @$items[$index]) continue; ?>
                            <div class="h-auto item swiper-slide"
                                <?=(new Galaxy\Canvas\BladeDirectives\CanvasEditableAttrsDirective($__env, $__data))->execute([
                                    'editor' => 'loop-swiper-LoopItemEditor',
                                    'label' => 'Item'
                                ])?>
                            >

                                <?php
                                    $color = ($criteria = $item->vacancyValues->where('unique_key', 'matchCriteria_15'))->contains('value', 'Werving en Selectie')
                                        ? 'text-palette-green' : ($criteria->contains('value', 'Uitzenden') ? 'text-palette-orange' : '');
                                    $background = ($criteria = $item->vacancyValues->where('unique_key', 'matchCriteria_15'))->contains('value', 'Werving en Selectie')
                                        ? 'bg-palette-green' : ($criteria->contains('value', 'Uitzenden') ? 'bg-palette-orange' : '');
                                ?>
                                <div class="flex flex-col h-full p-4 bg-white rounded-2xl md:p-8">
                                    <div class="mb-4 text-lg font-semibold title <?php echo e($color); ?>">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( $color == 'text-palette-green'): ?>
                                            <img class='inline-block w-8 mr-2 [transform:_translate3d(0,0,0)]' src='/img/website/groen_logo.svg' alt='Groen HRZeeland logo'>
                                        <?php elseif( $color == 'text-palette-orange'): ?>
                                            <img class='inline-block w-8 mr-2 [transform:_translate3d(0,0,0)]' src='/img/website/oranje_logo.svg' alt='Oranje HRZeeland logo'>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        <?php echo e($item->title); ?>

                                    </div>

                                    <div class="text-sm font-medium description">
                                        <?php echo \App\Services\VacancyService::getVacancyValue($item, 'textField_summary', 'text'); ?>

                                    </div>

                                    <div class="flex flex-col gap-4 pt-4 mt-auto xl:flex-row xl:items-center">
                                        <div class="flex items-center <?php echo e($color); ?>">
                                            <i class="mr-3 fa-2x far fa-location-dot"></i>
                                            <span class="font-medium"><?php echo e($item->locationCity); ?></span>
                                        </div>

                                        <div class="xl:ml-auto">
                                            <a class="block font-medium px-8 py-3 text-white rounded btn <?php echo e($background ? $background . ' hover:bg-opacity-75' : 'bg-palette-lightblue hover:bg-palette-blue'); ?>"
                                                href="<?php echo e(action([\App\Modules\Vacancy\Resources\Components\Website\Modules\Vacancy\Controller::class, 'show'], ['vacancy' => $item])); ?>"
                                            >
                                                <?php echo e(__('Bekijk vacature')); ?>

                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <?php (++$index); ?>
                        <?=last($__directiveInstances)->endItem($loop); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?=array_pop($__directiveInstances)->end(); ?>
                    </div>

                    <div class="flex justify-center gap-4 mt-4">
                        <!-- If we need navigation buttons -->
                        <div class="inline-flex items-center justify-center w-10 h-10 bg-white rounded-full button-prev hover:bg-opacity-75">
                            <i class="fas fa-angle-left"></i>
                        </div>
                        <div class="inline-flex items-center justify-center w-10 h-10 bg-white rounded-full button-next hover:bg-opacity-75">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>

        </div>
    </div>

</div>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/resources/components/canvas/blocks/custom/vacancySlider/block.blade.php ENDPATH**/ ?>