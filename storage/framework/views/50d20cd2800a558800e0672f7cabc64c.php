<?php if (! $__env->hasRenderedOnce('73d39b49-d24b-4136-9cb1-e499827a283f')): $__env->markAsRenderedOnce('73d39b49-d24b-4136-9cb1-e499827a283f'); ?>
    <link rel="stylesheet" href="/vendor/nouislider/nouislider.min.css">
    <script src="/vendor/nouislider/nouislider.min.js" defer></script>
<?php endif; ?>

<div class="container"
     id='vacancies'
     x-data="{
        open: false,
    }">

    <div class='grid grid-cols-3 py-8'>

        <div class='lg:col-span-1'>

            <div
                x-cloak
                x-show="open"
                class="filterMenu fixed lg:relative inset-0 z-50 lg:z-0 lg:!block"
                role="dialog"
                aria-modal="true"
            >
                <div x-show="open"
                     x-cloak
                     x-transition:enter="transition-opacity ease-linear duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity ease-linear duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-black bg-opacity-25 lg:bg-transparent"
                     @click="open = false"
                     aria-hidden="true"
                ></div>

                <div x-show="open"
                     x-cloak
                     x-transition:enter="transition ease-in-out duration-300 transform"
                     x-transition:enter-start="-translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transition ease-in-out duration-300 transform"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="-translate-x-full"
                     class="filterGroup relative max-w-xs lg:max-w-full w-full h-full bg-white lg:bg-transparent shadow-xl lg:shadow-none px-6 py-4 pb-6 lg:px-1 lg:py-0 flex flex-col overflow-y-auto lg:!block"
                >
                    <div class="flex items-center pb-4 mb-4 border-b lg:hidden">
                        <h3 class="mb-0 text-xl"><?php echo e(__('Filters')); ?></h3>
                        <button class="ml-auto" type="button" x-on:click="open = false">
                            <i class="text-xl fal fa-times"></i>
                        </button>
                    </div>

                    <div class='flex items-center justify-center w-full py-3 mb-4 transition border border-gray-400 rounded-lg cursor-pointer lg:w-3/5 hover:bg-black hover:border-black hover:text-white'
                         wire:click='resetFilter()'>
                        Filters wissen
                    </div>

                    <div class="flex flex-col gap-4 mb-4 lg:hidden">
                        <label class="px-4 py-2 border border-g™ray-200 rounded-lg hover:opacity-75 cursor-pointer
                            <?php echo e($this->checkInFilter('matchCriteria_15', 'Uitzenden') ? 'bg-gray-200 hover:bg-opacity-75' : ''); ?>

                        ">
                            <input type="checkbox" class="hidden"
                                wire:model.live="filter.matchCriteria_15.Uitzenden"
                            >
                            <i class='mr-2 text-base far fa-helmet-safety text-palette-orange'></i> <?php echo e(__('Operationeel & uitvoerend')); ?>

                        </label>

                        <label class="px-4 py-2 border border-gray-200 rounded-lg hover:opacity-75 cursor-pointer
                            <?php echo e($this->checkInFilter('matchCriteria_15', 'Werving en Selectie') ? 'bg-gray-200 hover:bg-opacity-75' : ''); ?>

                        ">
                            <input type="checkbox" class="hidden"
                                wire:model.live="filter.matchCriteria_15.Werving en Selectie"
                            >
                            <i class='mr-2 text-base far fa-display text-palette-green'></i> <?php echo e(__('Werving en Selectie')); ?>

                        </label>
                    </div>

                    <?php
                        $hoursRangeMin = \App\Modules\Vacancy\Http\Livewire\Overview::HOURS_RANGE_MIN;
                        $hoursRangeMax = \App\Modules\Vacancy\Http\Livewire\Overview::HOURS_RANGE_MAX;
                    ?>

                    <div class="mb-8" wire:ignore
                         x-data="{
                            displayMin: <?php echo \Illuminate\Support\Js::from($hoursMin ?? $hoursRangeMin)->toHtml() ?>,
                            displayMax: <?php echo \Illuminate\Support\Js::from($hoursMax ?? $hoursRangeMax)->toHtml() ?>,
                            isActive: <?php echo \Illuminate\Support\Js::from($hoursMin !== null || $hoursMax !== null)->toHtml() ?>,
                            tries: 0,
                            init() {
                                const el = this.$refs.slider;
                                const min = <?php echo e($hoursRangeMin); ?>;
                                const max = <?php echo e($hoursRangeMax); ?>;
                                const startMin = <?php echo \Illuminate\Support\Js::from($hoursMin)->toHtml() ?> ?? min;
                                const startMax = <?php echo \Illuminate\Support\Js::from($hoursMax)->toHtml() ?> ?? max;

                                const setup = () => {
                                    if (typeof window.noUiSlider === 'undefined') {
                                        if (this.tries++ < 30) return setTimeout(setup, 100);
                                        return console.warn('noUiSlider failed to load');
                                    }
                                    window.noUiSlider.create(el, {
                                        start: [startMin, startMax],
                                        connect: true,
                                        step: 1,
                                        range: { min, max },
                                    });
                                    el.noUiSlider.on('update', (values) => {
                                        this.displayMin = parseInt(values[0]);
                                        this.displayMax = parseInt(values[1]);
                                    });
                                    el.noUiSlider.on('change', (values) => {
                                        const newMin = parseInt(values[0]);
                                        const newMax = parseInt(values[1]);
                                        this.isActive = true;
                                        this.$wire.setHoursRange(newMin, newMax);
                                    });
                                };
                                setup();
                            },
                            reset() {
                                this.$refs.slider.noUiSlider.set([<?php echo e($hoursRangeMin); ?>, <?php echo e($hoursRangeMax); ?>]);
                                this.isActive = false;
                                this.$wire.clearHoursFilter();
                            }
                        }">
                        <div class='mb-3 text-base font-bold text-palette-lightblue'>
                            <?php echo e(__('Aantal uren per week')); ?>

                        </div>
                        <div class='flex items-center justify-between mb-3 text-sm text-gray-700'>
                            <span x-show="isActive">
                                <span x-text="displayMin"></span> – <span x-text="displayMax"></span> uur
                            </span>
                            <span x-show="!isActive" class="text-gray-500"><?php echo e(__('Alle uren')); ?></span>
                            <button type="button"
                                    x-show="isActive"
                                    x-on:click="reset()"
                                    class="text-xs text-palette-lightblue hover:underline">
                                <?php echo e(__('Wissen')); ?>

                            </button>
                        </div>
                        <div x-ref="slider" class="hours-slider"></div>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->vacancyValues->count() > 0): ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $this->matchCriteriaFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $matchCriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class='mb-8'>
                                <div class='mb-3 text-base font-bold text-palette-lightblue'>
                                    <?php echo e($this->vacancyValues->first(fn($value) => $value['unique_key'] === $matchCriteria && $value['key'] === 'value_title')['value']); ?>

                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $this->allVacancyValues->filter(fn($value) => $value['unique_key'] == $matchCriteria && $value['key'] !== 'value_title'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $vacancyValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php
                                        // Convert value to URL-safe format for wire:model
                                        $safeValue = $this->getEncodedValue($vacancyValue['value']);
                                    ?>
                                    <div class="relative flex items-center py-2">
                                        <div class="flex items-center h-6">
                                            <input
                                                id="box_<?php echo e($vacancyValue['id']); ?>"
                                                wire:model.live="filter.<?php echo e($vacancyValue['unique_key']); ?>.<?php echo e($safeValue); ?>"
                                                type="checkbox"
                                                checked='<?php echo e($this->checkInFilter($vacancyValue['unique_key'], $vacancyValue['value'])); ?>'
                                                class="w-5 h-5 border-2 border-gray-300 rounded cursor-pointer text-palette-lightblue focus:ring-palette-lighterblue"
                                            >
                                        </div>
                                        <div class="flex items-center justify-between w-full ml-3 lg:w-3/5 gap-x-4">
                                            <div>
                                                <label for="box_<?php echo e($vacancyValue['id']); ?>" class="text-base font-normal text-gray-900 cursor-pointer">
                                                    <?php echo e($vacancyValue['value']); ?>

                                                </label>
                                            </div>
                                            <div class='hidden text-gray-500'><?php echo e($this->filterCount[$vacancyValue['value']] ?? 0); ?></div>
                                        </div>
                                    </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

            </div>
        </div>

        <div class='col-span-3 lg:col-span-2'>
            <div class='items-center hidden mb-4 text-sm font-medium lg:flex'>
                <?php echo e($vacancyCount . ' resultaten'); ?>


                <div class="flex gap-4 ml-auto">
                    <label class="px-4 py-2 border border-gray-200 rounded-lg hover:opacity-75 cursor-pointer
                        <?php echo e($this->checkInFilter('matchCriteria_15', 'Uitzenden') ? 'bg-gray-200 hover:bg-opacity-75' : ''); ?>

                    ">
                        <input type="checkbox" class="hidden"
                               wire:model.live="filter.matchCriteria_15.Uitzenden"
                        >
                        <i class='mr-2 text-base far fa-helmet-safety text-palette-orange'></i> <?php echo e(__('Operationeel & uitvoerend')); ?>

                    </label>

                    <label class="px-4 py-2 border border-gray-200 rounded-lg hover:opacity-75 cursor-pointer
                        <?php echo e($this->checkInFilter('matchCriteria_15', 'Werving en Selectie') ? 'bg-gray-200 hover:bg-opacity-75' : ''); ?>

                    ">
                        <input type="checkbox" class="hidden"
                               wire:model.live="filter.matchCriteria_15.Werving en Selectie"
                        >
                        <i class='mr-2 text-base far fa-display text-palette-green'></i> <?php echo e(__('Werving en Selectie')); ?>

                    </label>
                </div>
            </div>

            <div class='lg:hidden'>
                <div class='flex items-center justify-between'>
                    <div class='text-sm font-medium'><?php echo e($vacancyCount . ' resultaten'); ?></div>
                    <div class='px-6 py-3 text-gray-500 border border-gray-200 rounded-lg hover:opacity-75' x-on:click="open = !open">
                        <i class='mr-2 far fa-sliders-up'></i> Filters
                    </div>
                </div>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $vacancies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vacancy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <?php ($colors = $this->getVacancyColor($vacancy)); ?>

                <?php ( $typeVacancy = $vacancy->vacancyValues->where('unique_key', 'matchCriteria_15')->where('key', '!=', 'value_title')->first() ); ?>
                <div class='flex flex-col items-start p-8 my-8 space-y-4 bg-white lg:my-10 rounded-xl' style='box-shadow: 0 8px 24px #0000001F;'
                    data-vacancy-type="<?php echo e($typeVacancy?->value ?: ''); ?>"
                >
                    <div class='text-2xl font-semibold <?php echo e($colors['color']); ?>'>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($colors['color'] == 'text-palette-green'): ?>
                            <img class='inline-block w-8' src='/img/website/groen_logo.svg' alt='Groen HRZeeland logo'>
                        <?php elseif($colors['color'] == 'text-palette-orange'): ?>
                            <img class='inline-block w-8 [transform:_translate3d(0,0,0)]' src='/img/website/oranje_logo.svg' alt='Oranje HRZeeland logo'>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php echo e($vacancy->title); ?>

                    </div>
                    <div class='font-medium text-base text-gray-500 leading-[30px] line-clamp-3'>
                        <?php echo $this->getVacancyValue($vacancy, 'textField_summary', 'text'); ?>

                    </div>
                    <div class='w-full grid md:items-start xl:items-center md:grid-cols-[repeat(auto-fill,_minmax(160px,_1fr))] xl:grid-cols-[2fr_repeat(3,_minmax(160px,_1fr))] 2xl:grid-cols-[repeat(auto-fill,_minmax(180px,_1fr))] gap-x-6 gap-y-4'>
                        <div class='flex items-center sm:order-1'>
                            <i class="mr-3 far fa-location-dot text-3xl fa-fw <?php echo e($colors['color']); ?>"></i>
                            <div class='text-sm font-medium <?php echo e($colors['color'] ?: 'text-gray-800'); ?>'>
                                <?php echo e($vacancy->location); ?>

                            </div>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showHours = $vacancy->vacancyValues->where('unique_key', 'matchCriteria_8')
                            ->where('key', '!=', 'value_title')
                            ->first()
                        ): ?>
                            <div class='flex items-center sm:order-1'>
                                <i class="mr-3 far fa-clock text-3xl fa-fw <?php echo e($colors['color']); ?>"></i>
                                <div class='text-sm font-medium <?php echo e($colors['color'] ?: 'text-gray-800'); ?>'>
                                    <?php echo e($showHours->value); ?>

                                </div>
                            </div>
                        <?php else: ?>
                            <div class="sm:order-1"></div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($saleryRange = implode(' - ', array_filter([
                            $vacancy->salaryMin ? '€' . number_format((float)str_replace('€', '', $vacancy->salaryMin), 0, ',', '.') : null,
                            $vacancy->salaryMax ? '€' .number_format((float)str_replace('€', '', $vacancy->salaryMax), 0, ',', '.') : null
                        ]))): ?>
                        <div class='flex items-center sm:order-1'>
                            <i class="mr-3 far fa-coins text-3xl fa-fw <?php echo e($colors['color']); ?>"></i>
                            <div class='text-sm font-medium <?php echo e($colors['color'] ?: 'text-gray-800'); ?>'>
                                <?php echo e($saleryRange); ?>

                            </div>
                        </div>
                        <?php else: ?>
                            <div class="sm:order-1"></div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <div class="order-1 xl:order-none lg:col-span-2 xl:col-auto">
                            <a class='block btn-primary-bigger-no-bg hover:bg-opacity-75 <?php echo e($colors['background'] ?: 'bg-black'); ?>'
                            href='<?php echo e(action([\App\Modules\Vacancy\Resources\Components\Website\Modules\Vacancy\Controller::class, 'show'], ['vacancy' => $vacancy])); ?>'
                            >
                                Bekijk vacature
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                Er zijn geen resultaten gevonden.
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class='py-4'>
                <?php echo e($vacancies->links('vacancy-component::website.modules.vacancy.partials.pagination')); ?>

            </div>

        </div>

    </div>

</div>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/app/Modules/Vacancy/resources/components//website/modules/vacancy/livewire/overview.blade.php ENDPATH**/ ?>