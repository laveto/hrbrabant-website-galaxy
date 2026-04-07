<?=(new Galaxy\Core\BladeDirectives\ResourceDirective($__env, $__data))->execute([
    '/vendor/swiper/swiper-bundle.min.css',
    '/vendor/swiper/swiper-bundle.min.js',
])?>

<div class="<?php echo e($cssNs); ?> z-30">

    <div class="relative">

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = optional(@$websitePage)->slider ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php ($sliderMedia = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($slider['image'])); ?>
        <?php $__env->startPush('head'); ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sliderMedia): ?>
                <link rel="preload" fetchpriority="high" as="image" href="<?php echo e($sliderMedia->getUrl()); ?>"
                    type="<?php echo e($sliderMedia->mime_type); ?>">
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php $__env->stopPush(); ?>

        <div class="relative item">

            <div class="absolute inset-0 pointer-events-none bg-gradient-to-b from-transparent to-palette-blue -z-10
                    [transform:_translate3d(0,0,0)]
                "></div>

            <div class="absolute inset-0 w-full h-full -z-20">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(
                        $sliderMedia &&
                        @$sliderMedia->model_type == "Galaxy\Website\Models\WebsitePage" &&
                        @$sliderMedia->collection_name == "default"
                    ): ?>

                    <?=(new Galaxy\Core\BladeDirectives\MediaDirective($__env, $__data))->execute($slider['image'], [
                        'collection' => 'default',
                        'fit' => 'cover',
                        'class' => 'w-full h-full object-cover',
                        'attributes' => [
                        'loading' => 'lazy',
                        ]
                    ])?>

                <?php else: ?>

                    <img src="<?php echo e(url('/img/common/placeholder.jpg')); ?>" class="object-cover w-full h-full"
                        alt="<?php echo e(config('app.name')); ?> Header Afbeelding" loading="lazy" />

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div
                class="aspect-1 <?php echo e($websitePage->is_homepage ? 'md:aspect-[6/2]' : 'md:aspect-[4/1]'); ?> flex flex-col items-center">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(@$slider['title'][request()->language()] || @$slider['description'][request()->language()]): ?>

                    <div class="container flex justify-center pt-12 pb-4 my-auto text-white lg:py-4">
                        <div class="flex flex-col items-center w-full text-center xl:w-3/5">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($title = @$slider['title'][request()->language()]): ?>
                                <div class="mb-4 text-base font-medium line-clamp-3 md:line-clamp-none lg:text-lg">
                                    <?php echo preg_replace('#\*{2}(.*?)\*{2}#', '<strong>$1</strong>', $title); ?>

                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($desc = @$slider['description'][request()->language()]): ?>
                                <h1 class="text-2xl text-white lg:text-5xl"><?php echo e($desc); ?></h1>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_array($slider) && ($sliderUrl = \Galaxy\Website\Services\WebsitePageService::getSliderUrl($slider)) && $sliderUrl['url']): ?>
                                <div class="flex mt-6 button-wrapper">
                                    <a href="<?php echo e($sliderUrl['url']); ?>" class="btn-secondary">
                                        <?php echo e($slider['websitepage_text'][request()->language()] ?? ''); ?>

                                    </a>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(@$websitePage->output_options['show_vacancy_search']): ?>
                <div class="container z-10 py-8 text-white">
                    <form class="flex flex-wrap items-center gap-4" method="GET"
                        action="<?php echo e(action([\App\Modules\Vacancy\Resources\Components\Website\Modules\Vacancy\Controller::class, 'index'])); ?>">
                        <div class="mr-auto text-3xl font-bold"><?php echo e(__('Zoek vacatures')); ?></div>

                        <div class="relative w-full lg:w-1/4">
                            <div class="absolute left-0 px-4 -translate-y-1/2 top-1/2">
                                <i class="text-white fas fa-search"></i>
                            </div>
                            <input type="text"
                                class="w-full py-3 pl-10 pr-5 text-white bg-transparent border border-white rounded-lg focus:ring-white focus:outline-white focus:shadow-white focus:border-white placeholder:text-white placeholder:opacity-50"
                                name="query" placeholder="<?php echo e(__('Functie trefwoord')); ?>"
                                value="<?php echo e(request()->input('query')); ?>">
                        </div>

                        <?php ($locations = \App\Modules\Vacancy\Models\VacancyValue::where('unique_key', 'matchCriteria_12')
                            ->where('key', '!=', 'value_title')
                            ->get()
                            ->unique('value')
                            ->pluck('value')
                        ); ?>
                        <?php ($selected = collect(request()->input('filter')['matchCriteria_12'] ?? [])->values()->toArray()); ?>
                        <div x-data="{ open: false, selected: <?php echo \Illuminate\Support\Js::from($selected)->toHtml() ?> }" class="relative w-full lg:w-1/4">
                            <div @click="open = !open"
                                class="w-full px-5 py-3 text-white bg-transparent border border-white rounded-lg cursor-pointer focus:ring-white focus:outline-white focus:shadow-white focus:border-white">
                                <span x-show="selected.length === 0"><?php echo e(__('Locatie')); ?></span>
                                <span x-show="selected.length > 0" x-text="selected.join(', ')"></span>
                                <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="text-white fas fa-chevron-down"></i>
                                </span>
                            </div>

                            <div x-show="open" @click.away="open = false"
                                class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg">
                                <template x-for="location in <?php echo e(json_encode($locations)); ?>" :key="location">
                                    <label class="flex items-center p-2 cursor-pointer">
                                        <input type="checkbox" :value="location"
                                            :name="'filter[matchCriteria_12][' + location + ']'" class="form-checkbox"
                                            @change="if ($event.target.checked) selected.push(location); else selected.splice(selected.indexOf(location), 1)"
                                            x-bind:checked="selected.includes(location)">
                                        <span class="ml-2 text-gray-700" x-text="location"></span>
                                    </label>
                                </template>
                            </div>
                        </div>

                        <button type="submit" class="w-full btn-secondary lg:w-auto"><?php echo e(__('Zoeken')); ?></button>
                    </form>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>

        </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="relative item">

            <div class="img-bg-wrapper -z-10 pb-[50%]">

                <img src="<?php echo e(url('/img/common/placeholder.jpg')); ?>" class="object-cover w-full"
                    alt="<?php echo e(config('app.name')); ?> Header Afbeelding" />

            </div>

        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

</div><?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/resources/views/vendor/website/layouts/main/slider.blade.php ENDPATH**/ ?>